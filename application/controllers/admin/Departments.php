<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends CI_Controller
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
     * View Function to display departments list view page
     *
     * @return html/string
     */
    public function listView()
    {
        $data['page'] = lang('departments');
        $data['menu'] = 'departments';
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/departments/list');
    }

    /**
     * Function to get data for departments jquery datatable
     *
     * @return json
     */
    public function data()
    {
        echo json_encode($this->AdminDepartmentModel->departmentsList());
    }    

    /**
     * View Function (for ajax) to display create or edit view page via modal
     *
     * @param integer $department_id
     * @return html/string
     */
    public function createOrEdit($department_id = NULL)
    {
        $department = objToArr($this->AdminDepartmentModel->getDepartment('department_id', $department_id));
        echo $this->load->view('admin/departments/create-or-edit', compact('department'), TRUE);
    }

    /**
     * Function (for ajax) to process department create or edit form request
     *
     * @return redirect
     */
    public function save()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('title', lang('title'), 'trim|required|min_length[2]|max_length[50]');

        $edit = $this->xssCleanInput('department_id') ? $this->xssCleanInput('department_id') : false;
        $imageUpload = $this->uploadImage($edit);

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } elseif ($this->AdminDepartmentModel->valueExist('title', $this->xssCleanInput('title'), $edit)) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('department_already_exist')))
            ));
        } elseif ($imageUpload['success'] == 'false') {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => $imageUpload['message']))
            ));
        } else {
            $data = $this->AdminDepartmentModel->storeDepartment($edit, $imageUpload['message']);
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('department') . ($edit ? lang('updated') : lang('created')))),
                'data' => $data
            ));
        }
    }

    /**
     * Function (for ajax) to process department change status request
     *
     * @param integer $department_id
     * @param string $status
     * @return void
     */
    public function changeStatus($department_id = null, $status = null)
    {
        $this->checkIfDemo();
        $this->AdminDepartmentModel->changeStatus($department_id, $status);
    }

    /**
     * Function (for ajax) to process department bulk action request
     *
     * @return void
     */
    public function bulkAction()
    {
        $this->checkIfDemo();
        $this->AdminDepartmentModel->bulkAction();
    }

    /**
     * Function (for ajax) to process department delete request
     *
     * @param integer $department_id
     * @return void
     */
    public function delete($department_id)
    {
        $this->checkIfDemo();
        $this->AdminDepartmentModel->remove($department_id);
    }

    /**
     * Private function to upload department image if any
     *
     * @param integer $edit
     * @return array
     */
    private function uploadImage($edit = false)
    {
        if ($_FILES['image']['name'] != '') {
            if ($edit) {
                $department = objToArr($this->AdminDepartmentModel->getDepartment('department_id', $edit));
                if ($department['image']) {
                    @unlink(ASSET_ROOT . '/images/departments/' . $department['image']);
                }
            }
            $file = explode('.', $_FILES['image']['name']);
            $filename = url_title(convert_accented_characters($_FILES['image']['name']), 'dash', true);
            $filename .= '-' . strtotime(date('Y-m-d G:i:s'));
            $config['upload_path'] = ASSET_ROOT . '/images/departments/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = $filename;
            $config['max_size'] = uploadLimit(1024);
            //$config['max_width'] = '200';
            //$config['max_height'] = '200';
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
