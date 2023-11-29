<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QuizQuestions extends CI_Controller
{
    /**
     * Constructor
     * 
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->checkAdminLogin();
    }

    /**
     * Function to get data for questions list
     *
     * @param integer $quiz_id
     * @return json
     */
    public function index($quiz_id = '')
    {
        $questions = $this->AdminQuizQuestionModel->getAll($quiz_id);
        echo $this->load->view('admin/quiz-questions/list-items', compact('questions'), TRUE);
    }

    /**
     * Function to add question to quiz from data bank by drag and drop
     *
     * @param integer $quiz_id
     * @param integer $question_id
     * @return json
     */
    public function add($quiz_id = '', $question_id = '')
    {
        $question = objToArr($this->AdminQuestionModel->getQuestion('question_id', $question_id));
        $answers = objToArr($this->AdminQuestionAnswerModel->getQuestionAnswers('question_id', $question_id));
        echo $this->AdminQuizQuestionModel->add($quiz_id, $question, $answers);
    }

    /**
     * View Function (for ajax) to display create or edit view page via modal
     *
     * @param integer $quiz_question_id
     * @return html/string
     */
    public function edit($quiz_question_id = NULL)
    {
        $data['question'] = objToArr($this->AdminQuizQuestionModel->get('quiz_question_id', $quiz_question_id));
        $data['answers'] = objToArr($this->AdminQuizQuestionModel->getQuizQuestionAnswers('quiz_question_id', $quiz_question_id));
        $data['type'] = $data['question']['type'] ? $data['question']['type'] : 'radio';
        echo $this->load->view('admin/quiz-questions/edit', $data, TRUE);
    }

    /**
     * Function (for ajax) to process question create or edit form request
     *
     * @return redirect
     */
    public function save()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('title', lang('title'), 'required|min_length[5]|max_length[1000]');
        $this->form_validation->set_rules('answer_titles[]', lang('option_value'), 'required|min_length[1]|max_length[50]');

        $edit = $this->xssCleanInput('quiz_question_id') ? $this->xssCleanInput('quiz_question_id') : false;
        $imageUpload = $this->uploadImage($edit);

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } elseif (!in_array(1, $this->xssCleanInput('answers'))) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('at_least_one_question')))
            ));
        } elseif (count($this->xssCleanInput('answers')) < 2) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('please_add_at_least_2_options')))
            ));
        } elseif ($imageUpload['success'] == 'false') {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => $imageUpload['message']))
            ));            
        } else {
            $this->AdminQuizQuestionModel->update($imageUpload['message']);
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('question_updated')))
            ));
        }
    }    

    /**
     * Post Function (via ajax) to order questions in quiz
     *
     * @return void
     */
    public function order()
    {
        $this->AdminQuizQuestionModel->orderQuestions();
    }

    /**
     * Post Function (via ajax) to delete question in quiz
     *
     * @return void
     */
    public function delete($quiz_question_id = '')
    {
        $this->checkIfDemo();
        $this->AdminQuizQuestionModel->delete($quiz_question_id);
    }

    /**
     * Function (for ajax) to process add new answer request to a opened question
     *
     * @param integer $quiz_question_id
     * @param string $type
     * @return html/string
     */
    public function addAnswer($quiz_question_id = '', $type = null)
    {
        $data['quiz_question_id'] = $quiz_question_id;
        $data['type'] = $type;
        echo $this->load->view('admin/quiz-questions/new-answer-item', $data, TRUE);
    }

    /**
     * Function (for ajax) to process remove answer request to a opened question
     *
     * @param integer $question_answer_id
     * @return void
     */
    public function removeAnswer($question_answer_id = '', $type = null)
    {
        $this->checkIfDemo();
        $this->checkAdminLogin();
        $this->AdminQuizQuestionModel->removeAnswer($question_answer_id);
    }

    /**
     * Function (for ajax) to process remove image request to a opened question
     *
     * @param integer $quiz_question_id
     * @return void
     */
    public function removeImage($quiz_question_id = '')
    {
        $this->checkIfDemo();
        $this->AdminQuizQuestionModel->removeImage($quiz_question_id);
    }
    
    /**
     * Private function to upload question image if any
     *
     * @param integer $edit
     * @return array
     */
    private function uploadImage($edit = false)
    {
        if ($_FILES['image']['name'] != '') {
            if ($edit) {
                $question = objToArr($this->AdminQuizQuestionModel->get('quiz_question_id', $edit));
                if ($question['image']) {
                    @unlink(ASSET_ROOT . '/images/questions/' . $question['image']);
                }
            }
            $file = explode('.', $_FILES['image']['name']);
            $filename = url_title(convert_accented_characters($_FILES['image']['name']), 'dash', true);
            $filename .= '-' . strtotime(date('Y-m-d G:i:s'));
            $config['upload_path'] = ASSET_ROOT . '/images/questions/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = $filename;
            $config['max_size'] = uploadLimit(1024);
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                return array(
                    'success' => 'false',
                    'message' => uploadImageError(uploadLimit(1024), lang('only_image_allowed_200'))                    
                );
            } else {
                $data = $this->upload->data();
                return array('success' => 'true', 'message' => $data['file_name']);
            }
        }
        return array('success' => 'true', 'message' => '');
    }    
}
