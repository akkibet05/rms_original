<?php

class AdminQuizModel extends CI_Model
{
    protected $table = 'quizes';
    protected $key = 'quiz_id';

    public function get($column, $value)
    {
        $this->db->where($column, $value);
        $result = $this->db->get('quizes');
        return ($result->num_rows() == 1) ? $result->row(0) : $this->emptyObject('quizes');
    }

    public function store($edit = null)
    {
        $data = $this->xssCleanInput();
        if ($edit) {
            $this->db->where('quiz_id', $edit);
            $data['updated_at'] = date('Y-m-d G:i:s');
            $this->db->update('quizes', $data);
            return array('id' => $edit, 'title' => $data['title']);
        } else {
            $data['created_at'] = date('Y-m-d G:i:s');
            $this->db->insert('quizes', $data);
            $id = $this->db->insert_id();
            return array('id' => $id, 'title' => $data['title']);
        }
    }

    public function cloneQuiz()
    {
        $data = $this->xssCleanInput();

        $quiz_id = $data['quiz_id'];
        unset($data['quiz_id']);

        //First create new quiz
        $data['created_at'] = date('Y-m-d G:i:s');
        $this->db->insert('quizes', $data);
        $new_quiz_id = $this->db->insert_id();
        
        //Second -> getting question of cloned quiz and inserting
        foreach ($this->quizQuestions($quiz_id) as $question) {
            $quiz_question_id_original = $question['quiz_question_id'];
            unset($question['quiz_question_id']);
            $question['quiz_id'] = $new_quiz_id;
            $this->db->insert('quiz_questions', $question);
            $quiz_question_id = $this->db->insert_id();

            //Third -> inserting question answers
            foreach ($this->quizQuestionAnswers($quiz_question_id_original) as $answer) {
                unset($answer['quiz_question_answer_id']);
                $answer['quiz_question_id'] = $quiz_question_id;
                $this->db->insert('quiz_question_answers', $answer);
                $answer_id = $this->db->insert_id();
           }
        }
    }

    public function remove($quiz_id)
    {
        //First getting quiz_question_ids
        $this->db->where('quiz_questions.quiz_id', $quiz_id);
        $this->db->select('GROUP_CONCAT('.CF_DB_PREFIX.'quiz_questions.quiz_question_id) AS ids');
        $query = $this->db->get('quiz_questions');
        $result = $query->result();
        $result = isset($result[0]->ids) ? $result[0]->ids : '';

        //Second deleting quiz_question_answers
        $this->db->where_in('quiz_question_answers.quiz_question_id', explode(',', $result));
        $this->db->delete('quiz_question_answers');

        //Third deleting quiz_questions
        $this->db->delete('quiz_questions', array('quiz_id' => $quiz_id));

        //Forht -> Finally deleting quiz
        $this->db->delete('quizes', array('quiz_id' => $quiz_id));
    }

    public function valueExist($field, $value, $edit = false)
    {
        $this->db->where($field, $value);
        if ($edit) {
            $this->db->where('quiz_id !=', $edit);
        }
        $query = $this->db->get('quizes');
        return $query->num_rows() > 0 ? true : false;
    }

    public function getAll()
    {
        $this->db->from($this->table);
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();
        return objToArr($query->result());
    }

    public function getDropDown($quiz_category_id = '')
    {
        if ($quiz_category_id) {
            $this->db->where('quiz_category_id', $quiz_category_id);
        }
        $this->db->select('quiz_id, title');
        $this->db->from($this->table);
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();
        return objToArr($query->result());
    }

    public function getCompleteQuiz($quiz_id)
    {
        $result = array();
        $result['quiz'] = $this->AdminQuizModel->get('quiz_id', $quiz_id);
        $result['questions'] = $this->AdminQuizModel->quizQuestions($quiz_id);
        foreach ($result['questions'] as $key => $question) {
            $answers = $this->AdminQuizModel->quizQuestionAnswers($question['quiz_question_id']);
            $result['questions'][$key]['answers'] = $answers;
        }
        return objToArr($result);
    }

    public function quizQuestions($quiz_id = '')
    {
        $this->db->where('quiz_id', $quiz_id);
        $this->db->order_by('order', 'ASC');
        $questions = $this->db->get('quiz_questions');
        $questions = objToArr($questions->result());
        return $questions;
    }

    public function quizQuestionAnswers($quiz_question_id = '')
    {
        $this->db->where('quiz_question_id', $quiz_question_id);
        $answers = $this->db->get('quiz_question_answers');
        $answers = objToArr($answers->result());
        return $answers;
    }

    public function getCandidateQuiz($column, $value)
    {
        $this->db->where($column, $value);
        $result = $this->db->get('candidate_quizes');
        return ($result->num_rows() == 1) ? objToArr($result->row(0)) : $this->emptyObject('candidate_quizes');
    }

    public function deleteCandidateQuiz($candidate_quiz_id)
    {
        $quiz = $this->getCandidateQuiz('candidate_quiz_id', $candidate_quiz_id);
        $this->db->delete('candidate_quizes', array('candidate_quiz_id' => $candidate_quiz_id));
        return array('job_id' => $quiz['job_id'], 'candidate_id' => $quiz['candidate_id']);
    }

}
