<?php

class AdminInterviewCategoryModel extends CI_Model
{
    protected $table = 'interview_categories';
    protected $key = 'interview_category_id';

    public function get($column, $value)
    {
        $this->db->where($column, $value);
        $result = $this->db->get('interview_categories');
        return ($result->num_rows() == 1) ? $result->row(0) : $this->emptyObject('interview_categories');
    }

    public function store($edit = null)
    {
        $data = $this->xssCleanInput();
        if ($edit) {
            $this->db->where('interview_category_id', $edit);
            $data['updated_at'] = date('Y-m-d G:i:s');
            $this->db->update('interview_categories', $data);
        } else {
            $data['created_at'] = date('Y-m-d G:i:s');
            $this->db->insert('interview_categories', $data);
            $id = $this->db->insert_id();
            return $id;
        }
    }

    public function changeStatus($interview_category_id, $status)
    {
        $this->db->where('interview_category_id', $interview_category_id);
        $this->db->update('interview_categories', array('status' => ($status == 1 ? 0 : 1)));
    }

    public function remove($interview_category_id)
    {
        $this->db->delete('interview_categories', array('interview_category_id' => $interview_category_id));
    }

    public function bulkAction()
    {
        $data = objToArr(json_decode($this->xssCleanInput('data')));
        $action = $data['action'];
        $ids = $data['ids'];
        switch ($action) {
            case "activate":
                $this->db->where_in('interview_category_id', $ids);
                $this->db->update('interview_categories', array('status' => 1));
            break;
            case "deactivate":
                $this->db->where_in('interview_category_id', $ids);
                $this->db->update('interview_categories', array('status' => '0'));
            break;
        }
    }

    public function valueExist($field, $value, $edit = false)
    {
        $this->db->where($field, $value);
        if ($edit) {
            $this->db->where('interview_category_id !=', $edit);
        }
        $query = $this->db->get('interview_categories');
        return $query->num_rows() > 0 ? true : false;
    }

    public function getAll($active = true)
    {
        if ($active) {
            $this->db->where('status', 1);
        }
        $this->db->from($this->table);
        $query = $this->db->get();
        return objToArr($query->result());
    }

    public function interviewCategoriesList()
    {
        $request = $this->input->post();
        $columns = array(
            "",
            "interview_categories.title",
            "interview_categories.created_at",
            "interview_categories.status",
        );
        $orderColumn = $columns[($request['order'][0]['column'] == 0 ? 5 : $request['order'][0]['column'])];
        $orderDirection = $request['order'][0]['dir'];
        $srh = $request['search']['value'];
        $limit = $request['length'];
        $offset = $request['start'];

        $this->db->from('interview_categories');
        $this->db->select('
            interview_categories.*
        ');
        if ($srh) {
            $this->db->group_start()->like('title', $srh)->group_end();
        }
        if (isset($request['status']) && $request['status'] != '') {
            $this->db->where('interview_categories.status', $request['status']);
        }
        $this->db->group_by('interview_categories.interview_category_id');
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
        $this->db->from('interview_categories');
        if ($srh) {
            $this->db->group_start()->like('title', $srh)->group_end();
        }
        if (isset($request['status']) && $request['status'] != '') {
            $this->db->where('interview_categories.status', $request['status']);
        }
        $this->db->group_by('interview_categories.interview_category_id');
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function prepareDataForTable($interview_categories)
    {
        $sorted = array();
        foreach ($interview_categories as $c) {
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
            if (allowedTo('edit_interview_categories')) { 
            $actions .= '
                <button type="button" class="btn btn-primary btn-xs create-or-edit-interview-category" data-id="'.$c['interview_category_id'].'"><i class="far fa-edit"></i></button>
            ';
            }
            if (allowedTo('delete_interview_categories')) { 
            $actions .= '
                <button type="button" class="btn btn-danger btn-xs delete-interview-category" data-id="'.$c['interview_category_id'].'"><i class="far fa-trash-alt"></i></button>
            ';
            }
            $sorted[] = array(
                "<input type='checkbox' class='minimal single-check' data-id='".$c['interview_category_id']."' />",
                esc_output($c['title'], 'html'),
                dateLang($c['created_at']),
                '<button type="button" title="'.$button_title.'" class="btn btn-'.$button_class.' btn-xs change-interview-category-status" data-status="'.$c['status'].'" data-id="'.$c['interview_category_id'].'">'.$button_text.'</button>',
                $actions
            );
        }
        return $sorted;
    }
}