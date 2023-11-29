<?php

class AdminInterviewModel extends CI_Model
{
    protected $table = 'interviews';
    protected $key = 'interview_id';

    public function get($column, $value)
    {
        $this->db->where($column, $value);
        $result = $this->db->get('interviews');
        return ($result->num_rows() == 1) ? $result->row(0) : $this->emptyObject('interviews');
    }

    public function store($edit = null)
    {
        $data = $this->xssCleanInput();
        if ($edit) {
            $this->db->where('interview_id', $edit);
            $data['updated_at'] = date('Y-m-d G:i:s');
            $this->db->update('interviews', $data);
            return array('id' => $edit, 'title' => $data['title']);
        } else {
            $data['created_at'] = date('Y-m-d G:i:s');
            $this->db->insert('interviews', $data);
            $id = $this->db->insert_id();
            return array('id' => $id, 'title' => $data['title']);
        }
    }

    public function cloneInterview()
    {
        $data = $this->xssCleanInput();

        $interview_id = $data['interview_id'];
        unset($data['interview_id']);

        //First create new interview
        $data['created_at'] = date('Y-m-d G:i:s');
        $this->db->insert('interviews', $data);
        $new_interview_id = $this->db->insert_id();
        
        //Second -> getting question of cloned interview and inserting
        foreach ($this->interviewQuestions($interview_id) as $question) {
            $interview_question_id_original = $question['interview_question_id'];
            unset($question['interview_question_id']);
            $question['interview_id'] = $new_interview_id;
            $this->db->insert('interview_questions', $question);
            $interview_question_id = $this->db->insert_id();
        }
    }

    public function remove($interview_id)
    {
        //First deleting interview_questions
        $this->db->delete('interview_questions', array('interview_id' => $interview_id));

        //Second -> Finally deleting interview
        $this->db->delete('interviews', array('interview_id' => $interview_id));
    }

    public function valueExist($field, $value, $edit = false)
    {
        $this->db->where($field, $value);
        if ($edit) {
            $this->db->where('interview_id !=', $edit);
        }
        $query = $this->db->get('interviews');
        return $query->num_rows() > 0 ? true : false;
    }

    public function getAll()
    {
        $this->db->from($this->table);
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();
        return objToArr($query->result());
    }

    public function getDropDown($interview_category_id = '')
    {
        if ($interview_category_id) {
            $this->db->where('interview_category_id', $interview_category_id);
        }
        $this->db->select('interview_id, title');
        $this->db->from($this->table);
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();
        return objToArr($query->result());
    }

    public function getCompleteInterview($interview_id)
    {
        $result = array();
        $result['interview'] = $this->AdminInterviewModel->get('interview_id', $interview_id);
        $result['questions'] = $this->AdminInterviewModel->interviewQuestions($interview_id);
        return objToArr($result);
    }

    public function interviewQuestions($interview_id = '')
    {
        $this->db->where('interview_id', $interview_id);
        $this->db->order_by('order', 'ASC');
        $questions = $this->db->get('interview_questions');
        $questions = objToArr($questions->result());
        return $questions;
    }

    public function getInterviewsCount()
    {
        $this->db->where('status', 1);
        $query = $this->db->get('candidate_interviews');
        return $query->num_rows();
    }    

}
