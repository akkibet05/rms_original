<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Traits extends CI_Controller
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
     * View Function to display traits list view page
     *
     * @return html/string
     */
    public function listView()
    {
        $data['page'] = 'Traits';
        $data['menu'] = 'traits';
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/traits/list');
    }

    /**
     * Function to get data for traits jquery datatable
     *
     * @return json
     */
    public function data()
    {
        echo json_encode($this->AdminTraitModel->traitsList());
    }    

    /**
     * View Function (for ajax) to display create or edit view page via modal
     *
     * @param integer $trait_id
     * @return html/string
     */
    public function createOrEdit($trait_id = NULL)
    {
        $trait = objToArr($this->AdminTraitModel->getTrait('trait_id', $trait_id));
        echo $this->load->view('admin/traits/create-or-edit', compact('trait'), TRUE);
    }

    /**
     * Function (for ajax) to process trait create or edit form request
     *
     * @return redirect
     */
    public function save()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('title', lang('title'), 'trim|required|min_length[2]|max_length[100]');

        $edit = $this->xssCleanInput('trait_id') ? $this->xssCleanInput('trait_id') : false;

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } elseif ($this->AdminTraitModel->valueExist('title', $this->xssCleanInput('title'), $edit)) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('trait_already_exist')))
            ));
        } else {
            $this->AdminTraitModel->storeTrait($edit);
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('trait').' ' . ($edit ? lang('updated') : lang('created'))))
            ));
        }
    }

    /**
     * Function (for ajax) to process trait change status request
     *
     * @param integer $trait_id
     * @param string $status
     * @return void
     */
    public function changeStatus($trait_id = null, $status = null)
    {
        $this->checkIfDemo();
        $this->AdminTraitModel->changeStatus($trait_id, $status);
    }

    /**
     * Function (for ajax) to process trait bulk action request
     *
     * @return void
     */
    public function bulkAction()
    {
        $this->checkIfDemo();
        $this->AdminTraitModel->bulkAction();
    }

    /**
     * Function (for ajax) to process trait delete request
     *
     * @param integer $trait_id
     * @return void
     */
    public function delete($trait_id)
    {
        $this->checkIfDemo();
        $this->AdminTraitModel->remove($trait_id);
    }
}
