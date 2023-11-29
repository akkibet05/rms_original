<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QuestionCategories extends CI_Controller
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
     * View Function to display Question Categories list view page
     *
     * @return html/string
     */
    public function listView()
    {
        $this->checkAdminLogin();
        $data['page'] = lang('question_categories');
        $data['menu'] = 'question_categories';
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/question-categories/list');
    }

    /**
     * Function to get data for Question Categories jquery datatable
     *
     * @return json
     */
    public function data()
    {
        echo json_encode($this->AdminQuestionCategoryModel->questionCategoriesList());
    }    

    /**
     * View Function (for ajax) to display create or edit view page via modal
     *
     * @param integer $question_category_id
     * @return html/string
     */
    public function createOrEdit($question_category_id = NULL)
    {
        $question_category = objToArr($this->AdminQuestionCategoryModel->get('question_category_id', $question_category_id));
        echo $this->load->view('admin/question-categories/create-or-edit', compact('question_category'), TRUE);
    }

    /**
     * Function (for ajax) to process Question Category create or edit form request
     *
     * @return redirect
     */
    public function save()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('title', lang('title'), 'trim|required|min_length[2]|max_length[50]');

        $edit = $this->xssCleanInput('question_category_id') ? $this->xssCleanInput('question_category_id') : false;

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } elseif ($this->AdminQuestionCategoryModel->valueExist('title', $this->xssCleanInput('title'), $edit)) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('question_category_already_exist')))
            ));
        } else {
            $this->AdminQuestionCategoryModel->store($edit);
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('question_category') . ($edit ? lang('updated') : lang('created'))))
            ));
        }
    }

    /**
     * Function (for ajax) to process Question Category change status request
     *
     * @param integer $question_category_id
     * @param string $status
     * @return void
     */
    public function changeStatus($question_category_id = null, $status = null)
    {
        $this->checkIfDemo();
        $this->AdminQuestionCategoryModel->changeStatus($question_category_id, $status);
    }

    /**
     * Function (for ajax) to process Question Category bulk action request
     *
     * @return void
     */
    public function bulkAction()
    {
        $this->checkIfDemo();
        $this->AdminQuestionCategoryModel->bulkAction();
    }

    /**
     * Function (for ajax) to process Question Category delete request
     *
     * @param integer $question_category_id
     * @return void
     */
    public function delete($question_category_id)
    {
        $this->checkIfDemo();
        $this->AdminQuestionCategoryModel->remove($question_category_id);
    }
}
