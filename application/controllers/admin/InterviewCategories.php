<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InterviewCategories extends CI_Controller
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
     * View Function to display Interview Categories list view page
     *
     * @return html/string
     */
    public function listView()
    {
        $data['page'] = lang('interview_categories');
        $data['menu'] = 'interview_categories';
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/interview-categories/list');
    }

    /**
     * Function to get data for Interview Categories jquery datatable
     *
     * @return json
     */
    public function data()
    {
        echo json_encode($this->AdminInterviewCategoryModel->interviewCategoriesList());
    }    

    /**
     * View Function (for ajax) to display create or edit view page via modal
     *
     * @param integer $interview_category_id
     * @return html/string
     */
    public function createOrEdit($interview_category_id = NULL)
    {
        $interview_category = objToArr($this->AdminInterviewCategoryModel->get('interview_category_id', $interview_category_id));
        echo $this->load->view('admin/interview-categories/create-or-edit', compact('interview_category'), TRUE);
    }

    /**
     * Function (for ajax) to process Interview Category create or edit form request
     *
     * @return redirect
     */
    public function save()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('title', lang('title'), 'trim|required|min_length[2]|max_length[50]');

        $edit = $this->xssCleanInput('interview_category_id') ? $this->xssCleanInput('interview_category_id') : false;

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } elseif ($this->AdminInterviewCategoryModel->valueExist('title', $this->xssCleanInput('title'), $edit)) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('interview_category_already_exist')))
            ));
        } else {
            $this->AdminInterviewCategoryModel->store($edit);
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' =>  lang('interview_category') . ($edit ? lang('updated') : lang('created'))))
            ));
        }
    }

    /**
     * Function (for ajax) to process Interview Category change status request
     *
     * @param integer $interview_category_id
     * @param string $status
     * @return void
     */
    public function changeStatus($interview_category_id = null, $status = null)
    {
        $this->checkIfDemo();
        $this->AdminInterviewCategoryModel->changeStatus($interview_category_id, $status);
    }

    /**
     * Function (for ajax) to process Interview Category bulk action request
     *
     * @return void
     */
    public function bulkAction()
    {
        $this->checkIfDemo();
        $this->AdminInterviewCategoryModel->bulkAction();
    }

    /**
     * Function (for ajax) to process Interview Category delete request
     *
     * @param integer $interview_category_id
     * @return void
     */
    public function delete($interview_category_id)
    {
        $this->checkIfDemo();
        $this->AdminInterviewCategoryModel->remove($interview_category_id);
    }
}
