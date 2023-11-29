<?php

class AdminTraitModel extends CI_Model
{
    protected $table = 'traits';
    protected $key = 'trait_id';

    public function getTrait($column, $value)
    {
        $this->db->where($column, $value);
        $result = $this->db->get('traits');
        return ($result->num_rows() == 1) ? $result->row(0) : $this->emptyObject('traits');
    }

    public function storeTrait($edit = null)
    {
        $data = $this->xssCleanInput();
        if ($edit) {
            $this->db->where('trait_id', $edit);
            $data['updated_at'] = date('Y-m-d G:i:s');
            $this->db->update('traits', $data);
        } else {
            $data['created_at'] = date('Y-m-d G:i:s');
            $this->db->insert('traits', $data);
            $id = $this->db->insert_id();
            return $id;
        }
    }

    public function changeStatus($trait_id, $status)
    {
        $this->db->where('trait_id', $trait_id);
        $this->db->update('traits', array('status' => ($status == 1 ? 0 : 1)));
    }

    public function remove($trait_id)
    {
        $this->db->delete('traits', array('trait_id' => $trait_id));
    }

    public function bulkAction()
    {
        $data = objToArr(json_decode($this->xssCleanInput('data')));
        $action = $data['action'];
        $ids = $data['ids'];
        switch ($action) {
            case "activate":
                $this->db->where_in('trait_id', $ids);
                $this->db->update('traits', array('status' => 1));
            break;
            case "deactivate":
                $this->db->where_in('trait_id', $ids);
                $this->db->update('traits', array('status' => '0'));
            break;
        }
    }

    public function valueExist($field, $value, $edit = false)
    {
        $this->db->where($field, $value);
        if ($edit) {
            $this->db->where('trait_id !=', $edit);
        }
        $query = $this->db->get('traits');
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

    public function traitsList()
    {
        $request = $this->input->post();
        $columns = array(
            "",
            "traits.title",
            "traits.created_at",
            "traits.status",
        );
        $orderColumn = $columns[($request['order'][0]['column'] == 0 ? 5 : $request['order'][0]['column'])];
        $orderDirection = $request['order'][0]['dir'];
        $srh = $request['search']['value'];
        $limit = $request['length'];
        $offset = $request['start'];

        $this->db->from('traits');
        $this->db->select('
            traits.*
        ');
        if ($srh) {
            $this->db->group_start()->like('title', $srh)->group_end();
        }
        if (isset($request['status']) && $request['status'] != '') {
            $this->db->where('traits.status', $request['status']);
        }
        $this->db->group_by('traits.trait_id');
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
        $this->db->from('traits');
        if ($srh) {
            $this->db->group_start()->like('title', $srh)->group_end();
        }
        if (isset($request['status']) && $request['status'] != '') {
            $this->db->where('traits.status', $request['status']);
        }
        $this->db->group_by('traits.trait_id');
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function prepareDataForTable($traits)
    {
        $sorted = array();
        foreach ($traits as $c) {
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
            if (allowedTo('edit_traits')) { 
            $actions .= '
                <button type="button" class="btn btn-primary btn-xs create-or-edit-trait" data-id="'.$c['trait_id'].'"><i class="far fa-edit"></i></button>
            ';
            }
            if (allowedTo('delete_traits')) { 
            $actions .= '
                <button type="button" class="btn btn-danger btn-xs delete-trait" data-id="'.$c['trait_id'].'"><i class="far fa-trash-alt"></i></button>
            ';
            }
            $sorted[] = array(
                "<input type='checkbox' class='minimal single-check' data-id='".$c['trait_id']."' />",
                esc_output($c['title'], 'html'),
                dateLang($c['created_at']),
                '<button type="button" title="'.$button_title.'" class="btn btn-'.$button_class.' btn-xs change-trait-status" data-status="'.$c['status'].'" data-id="'.$c['trait_id'].'">'.$button_text.'</button>',
                $actions
            );
        }
        return $sorted;
    }

    public function getJobTraits($job_id)
    {
        $this->db->where('job_traits.job_id', $job_id);
        $this->db->from('job_traits');
        $query = $this->db->get();
        return objToArr($query->result());
    }    
}