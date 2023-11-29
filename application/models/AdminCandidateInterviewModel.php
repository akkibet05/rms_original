<?php

class AdminCandidateInterviewModel extends CI_Model
{
    protected $table = 'candidate_interviews';
    protected $key = 'candidate_interview_id';

    public function getCandidateInterview($column, $value)
    {
        $this->db->where($column, $value);
        $result = $this->db->get('candidate_interviews');
        return ($result->num_rows() == 1) ? objToArr($result->row(0)) : $this->emptyObject('candidate_interviews');
    }

    public function storeCandidateInterview()
    {
        $data = $this->xssCleanInput();

        //Getting original candidate interview
        $interview = $this->getCandidateInterview('candidate_interview_id', $data['candidate_interview_id']);

        //Separaring out variables
        $result['overall_rating'] = array_sum($data['ratings']);
        $result['answers_data'] = json_encode(arrangeSections(array('rating' => $data['ratings'], 'comment' => $data['comments'])));
        $result['updated_at'] = date('Y-m-d G:i:s');
        $result['status'] = 1;
        $this->db->where('candidate_interview_id', $data['candidate_interview_id']);
        $this->db->update('candidate_interviews', $result);
        return array('job_id' => $interview['job_id'], 'candidate_id' => $interview['candidate_id']);
    }

    public function deleteCandidateInterview($candidate_interview_id)
    {
        $interview = $this->getCandidateInterview('candidate_interview_id', $candidate_interview_id);
        $this->db->delete('candidate_interviews', array('candidate_interview_id' => $candidate_interview_id));
        return array('job_id' => $interview['job_id'], 'candidate_id' => $interview['candidate_id']);
    }

    public function candidateInterviewsList()
    {
        $request = $this->input->post();
        $columns = array(
            "candidate_interviews.title",
            "candidates.candidate_id",
            "jobs.job_id",
            "users.user_id",
            "candidate_interviews.created_at",
            "candidate_interviews.status",
        );
        $orderColumn = $columns[($request['order'][0]['column'] == 0 ? 5 : $request['order'][0]['column'])];
        $orderDirection = $request['order'][0]['dir'];
        $srh = $request['search']['value'];
        $limit = $request['length'];
        $offset = $request['start'];

        $this->db->from('candidate_interviews');
        $this->db->select('
            candidate_interviews.*,
            jobs.title as job,
            CONCAT('.CF_DB_PREFIX.'users.first_name," ",'.CF_DB_PREFIX.'users.last_name) as user,
            CONCAT('.CF_DB_PREFIX.'candidates.first_name," ",'.CF_DB_PREFIX.'candidates.last_name) as candidate
        ');
        if ($srh) {
            $this->db->group_start()->like('candidates.first_name', $srh)
            ->or_like('candidates.last_name', $srh)->or_like('candidate_interviews.interview_title', $srh)->group_end();
        }
        if (isset($request['status']) && $request['status'] != '') {
            $this->db->where('candidate_interviews.status', $request['status']);
        }
        if (isset($request['job_id']) && $request['job_id'] != '') {
            $this->db->where('candidate_interviews.job_id', $request['job_id']);
        }
        if (isset($request['user_id']) && $request['user_id'] != '') {
            $this->db->where('candidate_interviews.user_id', $request['user_id']);
        }
        if (!allowedTo('all_candidate_interviews')) {
            $this->db->where('candidate_interviews.user_id', $this->session->userdata('admin')['user_id']);
        }
        $this->db->join('jobs', 'jobs.job_id = candidate_interviews.job_id', 'left');
        $this->db->join('users', 'users.user_id = candidate_interviews.user_id', 'left');
        $this->db->join('candidates', 'candidates.candidate_id = candidate_interviews.candidate_id', 'left');
        $this->db->group_by('candidate_interviews.candidate_interview_id');
        $this->db->order_by($orderColumn, $orderDirection);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();

        $result = array(
            'data' => $this->prepareDataForTable($query->result()),
            'recordsTotal' => $this->getTotal(),
            'recordsFiltered' => $this->getTotal($srh, $request),
        );

        return $result;
    }

    public function getTotal($srh = false, $request = '')
    {
        $this->db->from('candidate_interviews');
        if ($srh) {
            $this->db->group_start()->like('candidates.first_name', $srh)
            ->or_like('candidates.last_name', $srh)->or_like('candidate_interviews.interview_title', $srh)->group_end();
        }
        if (isset($request['status']) && $request['status'] != '') {
            $this->db->where('candidate_interviews.status', $request['status']);
        }
        if (isset($request['job_id']) && $request['job_id'] != '') {
            $this->db->where('candidate_interviews.job_id', $request['job_id']);
        }
        if (isset($request['user_id']) && $request['user_id'] != '') {
            $this->db->where('candidate_interviews.user_id', $request['user_id']);
        }
        if (!allowedTo('all_candidate_interviews')) {
            $this->db->where('candidate_interviews.user_id', $this->session->userdata('admin')['user_id']);
        }
        $this->db->join('jobs', 'jobs.job_id = candidate_interviews.job_id', 'left');
        $this->db->join('users', 'users.user_id = candidate_interviews.user_id', 'left');
        $this->db->join('candidates', 'candidates.candidate_id = candidate_interviews.candidate_id', 'left');

        $this->db->group_by('candidate_interviews.candidate_interview_id');
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function prepareDataForTable($candidate_interviews)
    {
        $sorted = array();
        foreach ($candidate_interviews as $c) {
            $c = objToArr($c);
            if ($c['status'] == 1) {
                $button_text = lang('done');
                $button_class = 'success';
                $button_title = lang('done');
            } else {
                $button_text = lang('pending');
                $button_class = 'warning';
                $button_title = lang('pending');
            }
            $actions = '
                <button type="button" class="btn btn-primary btn-xs view-or-conduct-candidate-interview" data-id="'.$c['candidate_interview_id'].'">
                '.lang('view').' / '.lang('conduct').'</button>
            ';
            $sorted[] = array(
                esc_output($c['interview_title'], 'html'),
                esc_output($c['candidate'], 'html'),
                esc_output($c['job'], 'html'),
                esc_output($c['user'], 'html'),
                dateLang($c['created_at']),
                '<button type="button" title="'.$button_title.'" class="btn btn-'.$button_class.' btn-xs change-candidate-interview-status" data-status="'.$c['status'].'" data-id="'.$c['candidate_interview_id'].'">'.$button_text.'</button>',
                $actions
            );
        }
        return $sorted;
    }
}