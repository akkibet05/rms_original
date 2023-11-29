<?php

class AdminQuestionModel extends CI_Model
{
    protected $table = 'questions';
    protected $key = 'question_id';

    public function getQuestion($column, $value)
    {
        $this->db->where($column, $value);
        $result = $this->db->get('questions');
        return ($result->num_rows() == 1) ? $result->row(0) : $this->emptyObject('questions');
    }

    public function storeQuestion($image = '')
    {
        $data = $this->xssCleanInput();
        if ($image) {
            $question['image'] = $image;
        }
        $question_id = $data['question_id'];

        //First inserting/updating question
        if ($question_id) {
            $question['question_category_id'] = $data['question_category_id'];
            $question['title'] = $data['title'];
            $question['type'] = isset($data['type']) ? $data['type'] : '';
            $question['updated_at'] = date('Y-m-d G:i:s');
            $this->db->where('question_id', $question_id);
            $this->db->update('questions', $question);
        } else {
            $question['question_category_id'] = $data['question_category_id'];
            $question['title'] = $data['title'];
            $question['type'] = isset($data['type']) ? $data['type'] : '';
            $question['nature'] = $data['nature'];
            $question['created_at'] = date('Y-m-d G:i:s');
            $question['updated_at'] = date('Y-m-d G:i:s');
            $this->db->insert('questions', $question);
            $question_id = $this->db->insert_id();
        }

        if ($data['nature'] == 'quiz') {
            //Second inserting/updating answers
            $customFields = array(
                'question_answer_id' => $data['answer_ids'], 
                'title' => $data['answer_titles'], 
                'is_correct' => $data['answers']
            );
            $answers = arrangeSections($customFields);
            foreach ($answers as $answer) {
                if ($answer['question_answer_id']) {
                    $this->db->where('question_answer_id', $answer['question_answer_id']);
                    $this->db->update('question_answers', $answer);
                } else {
                    $answer['question_id'] = $question_id;
                    unset($data['question_answer_id']);
                    $this->db->insert('question_answers', $answer);
                }
            }
        }
    }

    public function remove($question_id)
    {
        $this->db->delete('questions', array('question_id' => $question_id));
        $this->db->delete('question_answers', array('question_id' => $question_id));
    }

    public function removeAnswer($question_answer_id)
    {
        $this->db->delete('question_answers', array('question_answer_id' => $question_answer_id));
    }

    public function removeImage($question_id)
    {
        $this->db->where('question_id', $question_id);
        $this->db->update('questions', array('image' => ''));
    }

    public function valueExist($field, $value, $edit = false)
    {
        $this->db->where($field, $value);
        if ($edit) {
            $this->db->where('question_id !=', $edit);
        }
        $query = $this->db->get('questions');
        return $query->num_rows() > 0 ? true : false;
    }

    public function getAll($nature = 'quiz')
    {
        //Setting cookies for every of the request
        $this->setSessionValues();

        //First getting total records
        $total = $this->getTotal($nature);
        
        //Setting filters, search and pagination via posted session variables
        $search = $this->getSessionValues($nature.'_questions_search');
        $question_category_id = $this->getSessionValues($nature.'_questions_category_id');
        $type = $this->getSessionValues($nature.'_questions_type');
        $page = $this->getSessionValues($nature.'_questions_page', 1);
        $per_page = $this->getSessionValues($nature.'_questions_per_page', 10);
        $per_page = $per_page < $total ? $per_page : $total;
        $limit = $per_page;
        $offset = ($page == 1 ? 0 : ($page-1)) * $per_page;
        $offset = $offset < 0 ? 0 : $offset;

        $this->db->select('
            questions.*,
            COUNT(DISTINCT('.CF_DB_PREFIX.'question_answers.question_answer_id)) AS answers_count
        ');
        if ($search) {
            $this->db->group_start()->like('questions.title', $search)->group_end();
        }        
        if ($question_category_id) {
            $this->db->where('questions.question_category_id', $question_category_id);
        }
        if ($type) {
            $this->db->where('questions.type', $type);
        }
        $this->db->where('questions.nature', $nature);
        $this->db->join('question_categories','question_categories.question_category_id = questions.question_id', 'left');
        $this->db->join('question_answers','question_answers.question_id = questions.question_id', 'left');
        $this->db->from($this->table);
        $this->db->group_by('questions.question_id');
        $this->db->order_by('questions.created_at', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        $records = objToArr($query->result());

        //Making pagination for display
        $total_pages = $total != 0 ? ceil($total/$per_page) : 0;
        $pagination = ($offset == 0 ? 1 : ($offset+1));
        $pagination .= ' - ';
        $pagination .= $total_pages == $page ? $total : ($limit*$page);
        $pagination .= ' of ';
        $pagination .= $total;

        //Returning final results
        return array(
            'records' => $records,
            'total' =>  $total,
            'total_pages' => $total_pages,
            'pagination' => $pagination
        );
    }

    public function getTotal($nature = 'quiz')
    {
        $search = $this->session->userdata($nature.'_questions_search');
        $question_category_id = $this->session->userdata($nature.'_questions_category_id');
        $type = $this->session->userdata($nature.'_questions_type');

        if ($search) {
            $this->db->group_start()->like('questions.title', $search)->group_end();
        }        
        if ($question_category_id) {
            $this->db->where('questions.question_category_id', $question_category_id);
        }
        if ($type) {
            $this->db->where('questions.type', $type);
        }
        $this->db->where('questions.nature', $nature);
        $this->db->join('question_categories','question_categories.question_category_id = questions.question_id', 'left');
        $this->db->join('question_answers','question_answers.question_id = questions.question_id', 'left');
        $this->db->from($this->table);
        $this->db->group_by('questions.question_id');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function setSessionValues()
    {
        $data = $this->xssCleanInput();
        foreach ($data as $name => $value) {
            $this->session->set_userdata($name, $value);
        }
    }

    public function getSessionValues($name, $default = '')
    {
        return ($this->session->userdata($name) ? $this->session->userdata($name) : $default);
    }
}