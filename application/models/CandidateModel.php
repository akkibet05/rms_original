<?php

class CandidateModel extends CI_Model
{
    protected $table = 'candidates';
    protected $key = 'candidate_id';

    public function getFirst($column, $value)
    {
        $this->db->where($column, $value);
        $this->db->select('candidates.*');
        $this->db->from($this->table);
        $result = $this->db->get();
        return ($result->num_rows() == 1) ? objToArr($result->row(0)) : array();
    }

    public function valueExist($field, $value, $edit = false)
    {
        $this->db->where($field, $value);
        if ($edit) {
            $this->db->where('candidate_id !=', $edit);
        }
        $query = $this->db->get('candidates');
        return $query->num_rows() > 0 ? true : false;
    }

    public function login($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $this->db->where('status', 1);
        $result = $this->db->get('candidates');
        return ($result->num_rows() == 1) ? $result->row(0) : false;
    }

    public function createTokenForCandidate($email)
    {
        $this->db->where('email', $email);
        $this->db->update('candidates', array('token' => token()));
    }

    public function createCandidate($verification = false)
    {
        $data = $this->xssCleanInput();
        if ($verification) {
            $token = token();
            $data['token'] = $token;
            $data['status'] = 0;
        } else {
            $data['token'] = '';
            $data['status'] = 1;
        }
        unset($data['retype_password']);
        $data['image'] = '';
        $data['password'] = makePassword($data['password']);
        $data['account_type'] = 'site';
        $data['external_id'] = '';
        $data['created_at'] = date('Y-m-d G:i:s');
        $this->db->insert('candidates', $data);
        $id = $this->db->insert_id();
        return $this->getFirst('candidates.candidate_id', $id);
    }

    public function updateProfile($image)
    {
        $data = $this->xssCleanInput();
        $data['updated_at'] = date('Y-m-d G:i:s');
        if (isset($image['file'])) {
            $data['image'] = $image['file'];
        }
        $this->db->where('candidate_id', candidateSession());
        return $this->db->update('candidates', $data);
    }

    public function activateAccount($token)
    {
        $result = $this->getFirst('candidates.token', $token);
        if ($result) {
            $this->db->where('token', $token);
            $this->db->update(
                'candidates',
                array('status' => 1, 'token' => '', 'updated_at' => date('Y-m-d G:i:s'))
            );
            return true;
        } else {
            return false;
        }
    }

    public function updatePasswordByField($field, $value, $password)
    {
        $this->db->where($field, $value);
        $this->db->update('candidates', array('password' => $password, 'token' => ''));
        $this->session->set_userdata('password', $password);
        return true;
    }

    public function internalCandidate($email, $type)
    {
        $this->db->where('candidates.email', $email);
        $this->db->where('candidates.account_type != ', $type);
        $this->db->select('candidates.*');
        $this->db->from($this->table);
        $result = $this->db->get();
        return ($result->num_rows() == 1) ? true : false;
    }

    public function existingExternalCandidate($id, $email)
    {
        $this->db->where('candidates.email', $email);
        $this->db->where('candidates.external_id', $id);
        $this->db->select('candidates.*');
        $this->db->from($this->table);
        $result = $this->db->get();
        return ($result->num_rows() == 1) ? objToArr($result->row(0)) : array();
    }

    public function createGoogleCandidateIfNotExist($id, $email, $name, $image)
    {
        if ($this->internalCandidate($email, 'google')) {
            return false;
        } elseif ($this->existingExternalCandidate($id, $email)) {
            return $this->existingExternalCandidate($id, $email);
        } else {
            $this->insertCandidateImage($image, $id);
            $name = explode(' ', $name);
            $data['first_name'] = $name[0];
            $data['last_name'] = $name[1];
            $data['email'] = $name[0].$name[1];
            $data['email'] = $email;
            $data['image'] = $id.'.jpg';
            $data['password'] = makePassword($name[0].$name[1].$email);
            $data['status'] = 1;
            $data['account_type'] = 'google';
            $data['external_id'] = $id;
            $data['created_at'] = date('Y-m-d G:i:s');
            $this->db->insert('candidates', $data);
            return $this->existingExternalCandidate($id, $email);
        }
    }

    public function createLinkedinCandidateIfNotExist($apiData)
    {
        $id = $apiData['id'];
        $email = $apiData['email'];
        $first_name = $apiData['first_name'];
        $last_name = $apiData['last_name'];
        $image = $apiData['image'];
        if ($this->internalCandidate($email, 'linkedin')) {
            return false;
        } elseif ($this->existingExternalCandidate($id, $email)) {
            return $this->existingExternalCandidate($id, $email);
        } else {
            $this->insertCandidateImage($image, $id);
            $data['first_name'] = $first_name;
            $data['last_name'] = $last_name;
            $data['email'] = $first_name.$last_name;
            $data['email'] = $email;
            $data['image'] = $id.'.jpg';
            $data['password'] = makePassword($first_name.$last_name.$email);
            $data['status'] = 1;
            $data['account_type'] = 'linkedin';
            $data['external_id'] = $id;
            $data['created_at'] = date('Y-m-d G:i:s');
            $this->db->insert('candidates', $data);
            return $this->existingExternalCandidate($id, $email);
        }
    }

    private function insertCandidateImage($image, $id)
    {
        if (!empty($image)) {
            $name = $id.'.jpg';
            $full_path = ASSET_ROOT.'/images/candidates/'.$name;
            $content = remoteRequest($image);
            $fp = fopen($full_path, "w");
            fwrite($fp, $content);
            fclose($fp);
        }
    }

    public function storeAdminCandidate()
    {
        $data = $this->xssCleanInput();
        $data['password'] = makePassword($this->xssCleanInput('password'));
        $data['created_at'] = date('Y-m-d G:i:s');
        $data['candidate_type'] = 'admin';
        $data['candidate_level'] = 'admin';
        unset($data['retype_password']);
        return $this->db->insert('candidates', $data);
    }

    public function storeRememberMeToken($email, $token)
    {
        $this->db->where('email', $email);
        $this->db->update('candidates', array('token' => $token));
    }

    public function getCandidateWithRememberMeToken($token)
    {
        $this->db->where('candidates.token', $token);
        $this->db->select('candidates.*');
        $this->db->from($this->table);
        $result = $this->db->get();
        return ($result->num_rows() == 1) ? objToArr($result->row(0)) : array();
    }

    public function getCandidateInterviews($limit, $page = '')
    {
        $offset = $page > 1 ? (($page-1)*$limit) : 0;

        $this->db->where('candidate_interviews.candidate_id', candidateSession());
        $this->db->select('
            candidate_interviews.*,
            jobs.title as job_title,
        ');
        $this->db->join('jobs', 'jobs.job_id = candidate_interviews.job_id', 'left');
        $this->db->order_by('candidate_interviews.created_at', 'DESC');
        $this->db->group_by('candidate_interviews.candidate_interview_id');
        $this->db->limit($limit, $offset);
        $result = $this->db->get('candidate_interviews');
        return objToArr($result->result());
    }

    public function getTotalCandidateInterviews()
    {
        $this->db->from('candidate_interviews');
        $this->db->where('candidate_interviews.candidate_id', candidateSession());
        $this->db->group_by('candidate_interviews.candidate_interview_id');
        $query = $this->db->get();
        return $query->num_rows();
    }    
}