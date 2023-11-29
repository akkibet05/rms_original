<?php

class Roles extends CI_Controller
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
     * Function (for ajax) to display roles list in right modal
     *
     * @return view
     */
    public function listView()
    {
        $data['roles'] = $this->AdminRoleModel->getAll();
        $firstRoleId = isset($data['roles'][0]['role_id']) ? $data['roles'][0]['role_id'] : '';
        $data['permissions'] = $this->AdminRoleModel->getPermissions($firstRoleId);
        echo $this->load->view('admin/roles/list', $data, TRUE);
    }

    /**
     * Function (for ajax) to process role create or edit form request
     *
     * @return redirect
     */
    public function saveRole()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('title', lang('title'), 'required|min_length[2]|max_length[50]');

        $edit = $this->xssCleanInput('role_id') ? $this->xssCleanInput('role_id') : false;

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } elseif ($this->AdminRoleModel->valueExist('title', $this->xssCleanInput('title'), $edit)) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('role_already_exist')))
            ));
        } else {
            $data = $this->AdminRoleModel->storeRole($edit);
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('role').' ' . ($edit ? lang('updated') : lang('created')))),
                'data' => $data
            ));
        }
    }

    /**
     * Function (for ajax) to process role delete request
     *
     * @param integer $role_id
     * @return void
     */
    public function delete($role_id)
    {
        $this->checkIfDemo();
        $this->AdminRoleModel->remove($role_id);
    }

    /**
     * Function (for ajax) to get permissions for a role
     *
     * @param integer $role_id
     * @return void
     */
    public function getRolePermissions($role_id)
    {
        $permissions = $this->AdminRoleModel->getPermissions($role_id);
        echo $this->load->view('admin/roles/permissions-select', compact('permissions'), TRUE);
    }

    /**
     * Function (for ajax) to add permission to a role
     *
     * @param integer $role_id
     * @param integer $permission_id
     * @return void
     */
    public function addPermission($role_id, $permission_id)
    {
        $this->checkIfDemo();
        $this->AdminRoleModel->addPermission($role_id, $permission_id);
    }


    /**
     * Function (for ajax) to remove permission to a role
     *
     * @param integer $role_id
     * @param integer $permission_id
     * @return void
     */
    public function removePermission($role_id, $permission_id)
    {
        $this->checkIfDemo();
        $this->AdminRoleModel->removePermission($role_id, $permission_id);
    }

    /**
     * Function (for ajax) to display roles list in select2 multiselect
     *
     * @return view
     */
    public function rolesAsSelect2()
    {
        $data['roles'] = $this->AdminRoleModel->getAll();
        echo $this->load->view('admin/users/roles-bulk-assign', $data, TRUE);
    }
}
