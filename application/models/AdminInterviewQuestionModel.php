<?php

class AdminInterviewQuestionModel extends CI_Model
{
    protected $table = 'interview_questions';
    protected $key = 'interview_question_id';

    public function get($column, $value)
    {
        $this->db->where($column, $value);
        $result = $this->db->get('interview_questions');
        return ($result->num_rows() == 1) ? $result->row(0) : $this->emptyObject('interview_questions');
    }

    public function getAll($interview_id = '')
    {
        $this->db->select('
            interview_questions.*
        ');
        $this->db->where('interview_questions.interview_id', $interview_id);
        $this->db->from('interview_questions');
        $this->db->group_by('interview_questions.interview_question_id');
        $this->db->order_by('interview_questions.order', 'ASC');
        $query = $this->db->get();
        $records = objToArr($query->result());
        return $records;
    }

    public function update()
    {
        $data = $this->xssCleanInput();

        //First inserting/updating question
        $question['title'] = $data['title'];
        $question['updated_at'] = date('Y-m-d G:i:s');
        $this->db->where('interview_question_id', $data['interview_question_id']);
        $this->db->update('interview_questions', $question);
    }

    public function add($interview_id, $question, $answers)
    {
        unset($question['question_id'], $question['question_category_id'], $question['nature'], $question['type']);
        $question['interview_id'] = $interview_id;
        $question['order'] = 10000;
        $this->db->insert('interview_questions', $question);
        $id = $this->db->insert_id();
        return $id;
    }

    public function orderQuestions()
    {
        $data = $this->xssCleanInput();
        $data = json_decode($data['data']);
        $data = objToArr($data->items);

        foreach ($data as $d) {
            $this->db->where('interview_questions.interview_question_id', $d['id']);
            $this->db->update('interview_questions', array('order' => $d['order']));
        }
    }    

    public function delete($interview_question_id)
    {
        $this->db->delete('interview_questions', array('interview_question_id' => $interview_question_id));
    }    


    public function valueExist($field, $value, $edit = false)
    {
        $this->db->where($field, $value);
        if ($edit) {
            $this->db->where('interview_question_id !=', $edit);
        }
        $query = $this->db->get('interview_questions');
        return $query->num_rows() > 0 ? true : false;
    }
}