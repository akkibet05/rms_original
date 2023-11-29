<?php

class AdminDepartmentModel extends CI_Model
{
    protected $table = 'departments';
    protected $key = 'department_id';

    public function getDepartment($column, $value)
    {
        $this->db->where($column, $value);
        $result = $this->db->get('departments');
        return ($result->num_rows() == 1) ? $result->row(0) : $this->emptyObject('departments');
    }

    public function storeDepartment($edit = null, $image = '')
    {
        $data = $this->xssCleanInput();
        if ($image) {
            $data['image'] = $image;
        }
        if ($edit) {
            $this->db->where('department_id', $edit);
            $data['updated_at'] = date('Y-m-d G:i:s');
            $this->db->update('departments', $data);
        } else {
            $data['created_at'] = date('Y-m-d G:i:s');
            $this->db->insert('departments', $data);
            $id = $this->db->insert_id();
            return array('id' => $id, 'title' => $data['title']);
        }
    }

    public function changeStatus($department_id, $status)
    {
        $this->db->where('department_id', $department_id);
        $this->db->update('departments', array('status' => ($status == 1 ? 0 : 1)));
    }

    public function remove($department_id)
    {
        $this->db->delete('departments', array('department_id' => $department_id));
    }

    public function bulkAction()
    {
        $data = objToArr(json_decode($this->xssCleanInput('data')));
        $action = $data['action'];
        $ids = $data['ids'];
        switch ($action) {
            case "activate":
                $this->db->where_in('department_id', $ids);
                $this->db->update('departments', array('status' => 1));
            break;
            case "deactivate":
                $this->db->where_in('department_id', $ids);
                $this->db->update('departments', array('status' => '0'));
            break;
        }
    }

    public function valueExist($field, $value, $edit = false)
    {
        $this->db->where($field, $value);
        if ($edit) {
            $this->db->where('department_id !=', $edit);
        }
        $query = $this->db->get('departments');
        return $query->num_rows() > 0 ? true : false;
    }

    public function getAll($active = true)
    {
        if ($active) {
            $this->db->where('status', 1);
        }
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }

    public function departmentsList()
    {
        $request = $this->input->post();
        $columns = array(
            "",
            "",
            "departments.title",
            "departments.created_at",
            "departments.status",
        );
        $orderColumn = $columns[($request['order'][0]['column'] == 0 ? 5 : $request['order'][0]['column'])];
        $orderDirection = $request['order'][0]['dir'];
        $srh = $request['search']['value'];
        $limit = $request['length'];
        $offset = $request['start'];

        $this->db->from('departments');
        $this->db->select('
            departments.*
        ');
        if ($srh) {
            $this->db->group_start()->like('title', $srh)->group_end();
        }
        if (isset($request['status']) && $request['status'] != '') {
            $this->db->where('departments.status', $request['status']);
        }
        $this->db->group_by('departments.department_id');
        $this->db->order_by($orderColumn, $orderDirection);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();

        $result = array(
            'data' => $this->prepareDataForTable($query->result()),
            'recordsTotal' => $this->getTotal(),
            'recordsFiltered' => $this->getTotal($srh, $request),
        );

        return $result;
    }

    public function getTotal($srh = false, $request = '')
    {
        $this->db->from('departments');
        if ($srh) {
            $this->db->group_start()->like('title', $srh)->group_end();
        }
        if (isset($request['status']) && $request['status'] != '') {
            $this->db->where('departments.status', $request['status']);
        }
        $this->db->group_by('departments.department_id');
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function prepareDataForTable($departments)
    {
        $sorted = array();
        foreach ($departments as $c) {
            $actions = '';
            $c = objToArr($c);
            if ($c['status'] == 1) {
                $button_text = lang('active');
                $button_class = 'success';
                $button_title = lang('click_to_deactivate');
            } else {
                $button_text = lang('inactive');
                $button_class = 'danger';
                $button_title = lang('click_to_activate');
            }
            if (allowedTo('edit_departments')) {
            $actions .= '
                <button type="button" class="btn btn-primary btn-xs create-or-edit-department" data-id="'.$c['department_id'].'"><i class="far fa-edit"></i></button>
            ';
            }
            if (allowedTo('delete_departments')) { 
            $actions .= '
                <button type="button" class="btn btn-danger btn-xs delete-department" data-id="'.$c['department_id'].'"><i class="far fa-trash-alt"></i></button>
            ';
            }
            $default_image = base_url().'assets/images/not-found.png';
            $sorted[] = array(
                "<input type='checkbox' class='minimal single-check' data-id='".$c['department_id']."' />",
                "<img class='user-thumb-table' src='".departmentThumb($c['image'])."' onerror='this.src=\"".$default_image."\"'/>",
                esc_output($c['title'], 'html'),
                dateLang($c['created_at']),
                '<button type="button" title="'.$button_title.'" class="btn btn-'.$button_class.' btn-xs change-department-status" data-status="'.$c['status'].'" data-id="'.$c['department_id'].'">'.$button_text.'</button>',
                $actions
            );
        }
        return $sorted;
    }
}