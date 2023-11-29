<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Companies extends CI_Controller
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
     * View Function to display companies list view page
     *
     * @return html/string
     */
    public function listView()
    {
        $data['page'] = lang('companies');
        $data['menu'] = 'companies';
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/companies/list');
    }

    /**
     * Function to get data for companies jquery datatable
     *
     * @return json
     */
    public function data()
    {
        echo json_encode($this->AdminCompanyModel->companiesList());
    }    

    /**
     * View Function (for ajax) to display create or edit view page via modal
     *
     * @param integer $company_id
     * @return html/string
     */
    public function createOrEdit($company_id = NULL)
    {
        $company = objToArr($this->AdminCompanyModel->getCompany('company_id', $company_id));
        echo $this->load->view('admin/companies/create-or-edit', compact('company'), TRUE);
    }

    /**
     * Function (for ajax) to process company create or edit form request
     *
     * @return redirect
     */
    public function save()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('title', lang('title'), 'trim|required|min_length[2]|max_length[50]');

        $edit = $this->xssCleanInput('company_id') ? $this->xssCleanInput('company_id') : false;

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } elseif ($this->AdminCompanyModel->valueExist('title', $this->xssCleanInput('title'), $edit)) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('company_already_exist')))
            ));
        } else {
            $data = $this->AdminCompanyModel->storeCompany($edit);
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('company') . ($edit ? lang('updated') : lang('created')))),
                'data' => $data
            ));
        }
    }

    /**
     * Function (for ajax) to process company change status request
     *
     * @param integer $company_id
     * @param string $status
     * @return void
     */
    public function changeStatus($company_id = null, $status = null)
    {
        $this->checkIfDemo();
        $this->AdminCompanyModel->changeStatus($company_id, $status);
    }

    /**
     * Function (for ajax) to process company bulk action request
     *
     * @return void
     */
    public function bulkAction()
    {
        $this->checkIfDemo();
        $this->AdminCompanyModel->bulkAction();
    }

    /**
     * Function (for ajax) to process company delete request
     *
     * @param integer $company_id
     * @return void
     */
    public function delete($company_id)
    {
        $this->checkIfDemo();
        $this->AdminCompanyModel->remove($company_id);
    }
}
