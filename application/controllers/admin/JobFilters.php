<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JobFilters extends CI_Controller
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
     * View Function to display job_filters list view page
     *
     * @return html/string
     */
    public function listView()
    {
        $data['page'] = lang('job_filters');
        $data['menu'] = 'job_filters';
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/job-filters/list');
    }

    /**
     * Function to get data for job_filters jquery datatable
     *
     * @return json
     */
    public function data()
    {
        echo json_encode($this->AdminJobFilterModel->job_filtersList());
    }    

    /**
     * View Function (for ajax) to display create or edit view page via modal
     *
     * @param integer $job_filter_id
     * @return html/string
     */
    public function createOrEdit($job_filter_id = NULL)
    {
        $job_filter = objToArr($this->AdminJobFilterModel->getJobFilter('job_filter_id', $job_filter_id));
        echo $this->load->view('admin/job-filters/create-or-edit', compact('job_filter'), TRUE);
    }

    /**
     * Function (for ajax) to process job_filter create or edit form request
     *
     * @return redirect
     */
    public function save()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('title', lang('title'), 'trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('order', lang('order'), 'trim|required|min_length[1]|max_length[4]');

        $edit = $this->xssCleanInput('job_filter_id') ? $this->xssCleanInput('job_filter_id') : false;

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } elseif ($this->AdminJobFilterModel->valueExist('title', $this->xssCleanInput('title'), $edit)) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('job_filter_already_exists')))
            ));
        } else {
            $data = $this->AdminJobFilterModel->storeJobFilter($edit);
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('job_filter') . ($edit ? lang('updated') : lang('created')))),
                'data' => $data
            ));
        }
    }

    /**
     * View Function (for ajax) to display update values view page via modal
     *
     * @param integer $job_filter_id
     * @return html/string
     */
    public function updateValuesForm($job_filter_id = NULL)
    {
        $values = objToArr($this->AdminJobFilterModel->getAllValues($job_filter_id));
        echo $this->load->view('admin/job-filters/values', compact('values', 'job_filter_id'), TRUE);
    }

    /**
     * View Function (for ajax) to display new value field
     *
     * @param integer $job_filter_id
     * @return html/string
     */
    public function newValue($job_filter_id = NULL)
    {
        echo $this->load->view('admin/job-filters/value', array(), TRUE);
    }

    /**
     * Function (for ajax) to process job_filter update values form request
     *
     * @return redirect
     */
    public function updateValues()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('values[]', lang('value'), 'trim|required|min_length[2]|max_length[150]');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } else {
            $data = $this->AdminJobFilterModel->storeJobFilterValue();
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('job_filter') . lang('updated'))),
                'data' => $data
            ));
        }
    }

    /**
     * Function (for ajax) to process job_filter change status request
     *
     * @param integer $job_filter_id
     * @param string $status
     * @return void
     */
    public function changeStatus($job_filter_id = null, $status = null)
    {
        $this->checkIfDemo();
        $this->AdminJobFilterModel->changeStatus($job_filter_id, $status);
    }

    /**
     * Function (for ajax) to process job_filter bulk action request
     *
     * @return void
     */
    public function bulkAction()
    {
        $this->checkIfDemo();
        $this->AdminJobFilterModel->bulkAction();
    }

    /**
     * Function (for ajax) to process job_filter delete request
     *
     * @param integer $job_filter_id
     * @return void
     */
    public function delete($job_filter_id)
    {
        $this->checkIfDemo();
        $this->AdminJobFilterModel->remove($job_filter_id);
    }
}
