<?php

class AdminQuizQuestionModel extends CI_Model
{
    protected $table = 'quiz_questions';
    protected $key = 'quiz_question_id';

    public function getQuizQuestionAnswers($column, $value)
    {
        $this->db->where($column, $value);
        $result = $this->db->get('quiz_question_answers');
        return objToArr($result->result());
    }

    public function get($column, $value)
    {
        $this->db->where($column, $value);
        $result = $this->db->get('quiz_questions');
        return ($result->num_rows() == 1) ? $result->row(0) : $this->emptyObject('quiz_questions');
    }

    public function getAll($quiz_id = '')
    {
        $this->db->select('
            quiz_questions.*,
            COUNT(DISTINCT('.CF_DB_PREFIX.'quiz_question_answers.quiz_question_answer_id)) AS answers_count
        ');
        $this->db->where('quiz_questions.quiz_id', $quiz_id);
        $this->db->join('quiz_question_answers', 'quiz_question_answers.quiz_question_id = quiz_questions.quiz_question_id', 'left');
        $this->db->from('quiz_questions');
        $this->db->group_by('quiz_questions.quiz_question_id');
        $this->db->order_by('quiz_questions.order', 'ASC');
        $query = $this->db->get();
        $records = objToArr($query->result());
        return $records;
    }

    public function update($image = '')
    {
        $data = $this->xssCleanInput();
        if ($image) {
            $question['image'] = $image;
        }

        //First inserting/updating question
        $question['title'] = $data['title'];
        $question['type'] = $data['type'];
        $question['updated_at'] = date('Y-m-d G:i:s');
        $this->db->where('quiz_question_id', $data['quiz_question_id']);
        $this->db->update('quiz_questions', $question);

        //Second Arranging answers
        $answers = arrangeSections(array(
            'quiz_question_answer_id' => $data['answer_ids'], 
            'title' => $data['answer_titles'], 
            'is_correct' => $data['answers']
        ));

        //Third inserting or updating answers
        foreach ($answers as $answer) {
            if ($answer['quiz_question_answer_id']) {
                $this->db->where('quiz_question_answer_id', $answer['quiz_question_answer_id']);
                $this->db->update('quiz_question_answers', $answer);
            } else {
                $answer['quiz_question_id'] = $data['quiz_question_id'];
                unset($data['quiz_question_answer_id']);
                $this->db->insert('quiz_question_answers', $answer);
            }
        }
    }

    public function add($quiz_id, $question, $answers)
    {
        //First inserting question
        unset($question['question_id'], $question['question_category_id'], $question['nature']);
        $question['quiz_id'] = $quiz_id;
        $question['order'] = 10000;
        $this->db->insert('quiz_questions', $question);
        $id = $this->db->insert_id();
        
        //Second inserting answers
        foreach ($answers as $answer) {
            unset($answer['question_answer_id'], $answer['question_id']);
            $answer['quiz_question_id'] = $id;
            $this->db->insert('quiz_question_answers', $answer);
        }
        
        return $id;
    }

    public function orderQuestions()
    {
        $data = $this->xssCleanInput();
        $data = json_decode($data['data']);
        $data = objToArr($data->items);

        foreach ($data as $d) {
            $this->db->where('quiz_questions.quiz_question_id', $d['id']);
            $this->db->update('quiz_questions', array('order' => $d['order']));
        }
    }    

    public function delete($quiz_question_id)
    {
        $this->db->delete('quiz_questions', array('quiz_question_id' => $quiz_question_id));
        $this->db->delete('quiz_question_answers', array('quiz_question_id' => $quiz_question_id));
    }    


    public function valueExist($field, $value, $edit = false)
    {
        $this->db->where($field, $value);
        if ($edit) {
            $this->db->where('quiz_question_id !=', $edit);
        }
        $query = $this->db->get('quiz_questions');
        return $query->num_rows() > 0 ? true : false;
    }

    public function removeAnswer($quiz_question_answer_id)
    {
        $this->db->delete('quiz_question_answers', array('quiz_question_answer_id' => $quiz_question_answer_id));
    }

    public function removeImage($quiz_question_id)
    {
        $this->db->where('quiz_question_id', $quiz_question_id);
        $this->db->update('quiz_questions', array('image' => ''));
    }  
}