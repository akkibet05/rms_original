<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BlogCategories extends CI_Controller
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
     * View Function to display Blog Categories list view page
     *
     * @return html/string
     */
    public function listView()
    {
        $data['page'] = lang('blog_categories');
        $data['menu'] = 'blog_categories';
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/blog-categories/list');
    }

    /**
     * Function to get data for Blog Categories jquery datatable
     *
     * @return json
     */
    public function data()
    {
        echo json_encode($this->AdminBlogCategoryModel->blogCategoriesList());
    }    

    /**
     * View Function (for ajax) to display create or edit view page via modal
     *
     * @param integer $blog_category_id
     * @return html/string
     */
    public function createOrEdit($blog_category_id = NULL)
    {
        $blog_category = objToArr($this->AdminBlogCategoryModel->get('blog_category_id', $blog_category_id));
        echo $this->load->view('admin/blog-categories/create-or-edit', compact('blog_category'), TRUE);
    }

    /**
     * Function (for ajax) to process Blog Category create or edit form request
     *
     * @return redirect
     */
    public function save()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('title', lang('title'), 'required|min_length[2]|max_length[50]');

        $edit = $this->xssCleanInput('blog_category_id') ? $this->xssCleanInput('blog_category_id') : false;

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } elseif ($this->AdminBlogCategoryModel->valueExist('title', $this->xssCleanInput('title'), $edit)) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('blog_category_already_exist')))
            ));
        } else {
            $this->AdminBlogCategoryModel->store($edit);
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('blog_category') . ($edit ? lang('updated') : lang('created')))
            )));
        }
    }

    /**
     * Function (for ajax) to process Blog Category change status request
     *
     * @param integer $blog_category_id
     * @param string $status
     * @return void
     */
    public function changeStatus($blog_category_id = null, $status = null)
    {
        $this->checkIfDemo();
        $this->AdminBlogCategoryModel->changeStatus($blog_category_id, $status);
    }

    /**
     * Function (for ajax) to process Blog Category bulk action request
     *
     * @return void
     */
    public function bulkAction()
    {
        $this->checkIfDemo();
        $this->AdminBlogCategoryModel->bulkAction();
    }

    /**
     * Function (for ajax) to process Blog Category delete request
     *
     * @param integer $blog_category_id
     * @return void
     */
    public function delete($blog_category_id)
    {
        $this->checkIfDemo();
        $this->AdminBlogCategoryModel->remove($blog_category_id);
    }
}
