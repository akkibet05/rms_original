<?php

class AdminQuestionAnswerModel extends CI_Model
{
    protected $table = 'question_answers';
    protected $key = 'question_answer_id';

    public function getQuestionAnswer($column, $value)
    {
        $this->db->where($column, $value);
        $result = $this->db->get('question_answers');
        return ($result->num_rows() == 1) ? $result->row(0) : $this->emptyObject('question_answers');
    }

    public function getQuestionAnswers($column, $value)
    {
        $this->db->where($column, $value);
        $result = $this->db->get('question_answers');
        return objToArr($result->result());
    }

    public function remove($question_answer_id)
    {
        $this->db->delete('question_answers', array('question_answer_id' => $question_answer_id));
        $this->db->delete('question_answers', array('question_answer_id' => $question_answer_id));
    }

    public function valueExist($field, $value, $edit = false)
    {
        $this->db->where($field, $value);
        if ($edit) {
            $this->db->where('question_answer_id !=', $edit);
        }
        $query = $this->db->get('question_answers');
        return $query->num_rows() > 0 ? true : false;
    }

}