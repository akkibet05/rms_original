<?php

class Todos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkAdminLogin();
    }

    /**
     * Function (via ajax) to get to do list for team members
     *
     * @return json
     */
    public function listView()
    {
        $todosResults = $this->AdminToDoModel->getTodos();
        $todos = $todosResults['records'];
        echo json_encode(array(
            'pagination' => $todosResults['pagination'],
            'total_pages' => $todosResults['total_pages'],
            'list' => $this->load->view('admin/todos/item', compact('todos'), TRUE),
        ));
    }

    /**
     * Function (via ajax) to view create or edit to do
     *
     * @param $to_do_id integer
     * @return void
     */
    public function createOrEditToDo($to_do_id = '')
    {
        $this->checkAdminLogin();
        $to_do = $this->AdminToDoModel->getToDo('to_do_id', $to_do_id);
        echo $this->load->view('admin/todos/create-or-edit', compact('to_do'), TRUE);
    }

    /**
     * Function (for ajax) to process question create or edit form request
     *
     * @return redirect
     */
    public function save()
    {
        $this->checkIfDemo();
        $this->checkAdminLogin();
        $this->form_validation->set_rules('title', lang('title'), 'trim|required|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('description', lang('description'), 'required|min_length[10]|max_length[1000]');
        
        $edit = $this->xssCleanInput('to_do_id') ? $this->xssCleanInput('to_do_id') : false;

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } else {
            $this->AdminToDoModel->store();
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('to_do_item').' ' . ($edit ? lang('updated') : lang('created'))))
            ));
        }
    }

    /**
     * Function (via ajax) to mark status of to do list item
     *
     * @param $id integer
     * @param $status integer
     * @return void
     */
    public function todoStatus($id, $status)
    {
        $this->AdminToDoModel->todoStatus($id, $status);
    }

    /**
     * Function (for ajax) to process todo delete request
     *
     * @param integer $to_do_id
     * @return void
     */
    public function delete($to_do_id)
    {
        $this->checkIfDemo();
        $this->checkAdminLogin();
        $this->AdminToDoModel->remove($to_do_id);
    }
}
