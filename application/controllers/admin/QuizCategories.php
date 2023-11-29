<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QuizCategories extends CI_Controller
{
    /**
     * View Function to display Quiz Categories list view page
     *
     * @return html/string
     */
    public function listView()
    {
        $this->checkAdminLogin();
        $data['page'] = lang('quiz_categories');
        $data['menu'] = 'quiz_categories';
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/quiz-categories/list');
    }

    /**
     * Function to get data for Quiz Categories jquery datatable
     *
     * @return json
     */
    public function data()
    {
        echo json_encode($this->AdminQuizCategoryModel->quizCategoriesList());
    }    

    /**
     * View Function (for ajax) to display create or edit view page via modal
     *
     * @param integer $quiz_category_id
     * @return html/string
     */
    public function createOrEdit($quiz_category_id = NULL)
    {
        $quiz_category = objToArr($this->AdminQuizCategoryModel->get('quiz_category_id', $quiz_category_id));
        echo $this->load->view('admin/quiz-categories/create-or-edit', compact('quiz_category'), TRUE);
    }

    /**
     * Function (for ajax) to process Quiz Category create or edit form request
     *
     * @return redirect
     */
    public function save()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('title', lang('title'), 'trim|required|min_length[2]|max_length[50]');

        $edit = $this->xssCleanInput('quiz_category_id') ? $this->xssCleanInput('quiz_category_id') : false;

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } elseif ($this->AdminQuizCategoryModel->valueExist('title', $this->xssCleanInput('title'), $edit)) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('quiz_category_already_exist')))
            ));
        } else {
            $this->AdminQuizCategoryModel->store($edit);
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' =>  lang('quiz_category') . ($edit ? lang('updated') : lang('created'))))
            ));
        }
    }

    /**
     * Function (for ajax) to process Quiz Category change status request
     *
     * @param integer $quiz_category_id
     * @param string $status
     * @return void
     */
    public function changeStatus($quiz_category_id = null, $status = null)
    {
        $this->checkIfDemo();
        $this->AdminQuizCategoryModel->changeStatus($quiz_category_id, $status);
    }

    /**
     * Function (for ajax) to process Quiz Category bulk action request
     *
     * @return void
     */
    public function bulkAction()
    {
        $this->checkIfDemo();
        $this->AdminQuizCategoryModel->bulkAction();
    }

    /**
     * Function (for ajax) to process Quiz Category delete request
     *
     * @param integer $quiz_category_id
     * @return void
     */
    public function delete($quiz_category_id)
    {
        $this->checkIfDemo();
        $this->AdminQuizCategoryModel->remove($quiz_category_id);
    }
}
