<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questions extends CI_Controller
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
     * @param  $nature string
     * @return json
     */
    public function index($nature = 'quiz')
    {
        $questionsResults = $this->AdminQuestionModel->getAll($nature);
        $questions = $questionsResults['records'];
        echo json_encode(array(
            'pagination' => $questionsResults['pagination'],
            'total_pages' => $questionsResults['total_pages'],
            'list' => $this->load->view('admin/questions/list-items', compact('questions', 'nature'), TRUE),
        ));
    }    

    /**
     * View Function (for ajax) to display create or edit view page via modal
     *
     * @param string $nature
     * @param integer $question_id
     * @return html/string
     */
    public function createOrEdit($nature = '', $question_id = NULL)
    {
        $data['question'] = objToArr($this->AdminQuestionModel->getQuestion('question_id', $question_id));
        $data['answers'] = objToArr($this->AdminQuestionAnswerModel->getQuestionAnswers('question_id', $question_id));
        $data['question_categories'] = $this->AdminQuestionCategoryModel->getAll();
        $data['type'] = $data['question']['type'] ? $data['question']['type'] : 'radio';
        $data['nature'] = $nature;
        echo $this->load->view('admin/questions/create-or-edit', $data, TRUE);
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

        if ($this->xssCleanInput('nature') == 'quiz') {
        $this->form_validation->set_rules('answer_titles[]', lang('option_value'), 'required|min_length[1]|max_length[500]');
        }
        $answers = $this->xssCleanInput('answers') ? $this->xssCleanInput('answers') : array();
        
        $edit = $this->xssCleanInput('question_id') ? $this->xssCleanInput('question_id') : false;
        $imageUpload = $this->uploadImage($edit);

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } elseif (!in_array(1, $answers) && $this->xssCleanInput('nature') == 'quiz') {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('at_least_one_question')))
            ));
        } elseif (count($answers) < 2 && $this->xssCleanInput('nature') == 'quiz') {
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
            $this->AdminQuestionModel->storeQuestion($imageUpload['message']);
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('question') . ($edit ? lang('updated') : lang('created'))))
            ));
        }
    }

    /**
     * Function (for ajax) to process question delete request
     *
     * @param integer $question_id
     * @return void
     */
    public function delete($question_id)
    {
        $this->checkIfDemo();
        $this->AdminQuestionModel->remove($question_id);
    }

    /**
     * Function (for ajax) to process add new answer request to a opened question
     *
     * @param string $type
     * @param integer $question_id
     * @return html/string
     */
    public function addAnswer($type = '', $question_id = '')
    {
        $data['question_id'] = $question_id;
        $data['type'] = $type;
        echo $this->load->view('admin/questions/new-answer-item', $data, TRUE);
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
        $this->AdminQuestionModel->removeAnswer($question_answer_id);
    }

    /**
     * Function (for ajax) to process remove image request to a opened question
     *
     * @param integer $question_id
     * @return void
     */
    public function removeImage($question_id = '')
    {
        $this->checkIfDemo();
        $this->AdminQuestionModel->removeImage($question_id);
    }

    /**
     * Private function to upload question image if any
     *
     * @param integer $edit
     * @return array
     */
    private function uploadImage($edit = false)
    {
        if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
            if ($edit) {
                $question = objToArr($this->AdminQuestionModel->getQuestion('question_id', $edit));
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
