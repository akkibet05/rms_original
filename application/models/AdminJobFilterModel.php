<?php

class AdminJobFilterModel extends CI_Model
{
    protected $table = 'job_filters';
    protected $key = 'job_filter_id';

    public function getJobFilter($column, $value)
    {
        $this->db->where($column, $value);
        $result = $this->db->get('job_filters');
        return ($result->num_rows() == 1) ? $result->row(0) : $this->emptyObject('job_filters');
    }

    public function storeJobFilter($edit = null)
    {
        $data = $this->xssCleanInput();
        if ($edit) {
            $this->db->where('job_filter_id', $edit);
            $data['updated_at'] = date('Y-m-d G:i:s');
            $this->db->update('job_filters', $data);
        } else {
            $data['created_at'] = date('Y-m-d G:i:s');
            $this->db->insert('job_filters', $data);
            $id = $this->db->insert_id();
            return array('id' => $id, 'title' => $data['title']);
        }
    }

    public function storeJobFilterValue()
    {
        $data = $this->xssCleanInput();
        $job_filter_id = $data['job_filter_id'];

        $fields = array(
            'id' => $data['ids'], 
            'value' => $data['values'], 
        );
        $values = arrangeSections($fields);

        //Deleting any if not in input
        $this->db->where('job_filter_id', $job_filter_id);
        $this->db->where_not_in('job_filter_value_id', $data['ids']);
        $this->db->delete('job_filter_values');

        //Delete from job filter / field if any
        $this->db->where('job_filter_id', $job_filter_id);
        $this->db->where_not_in('job_filter_value_id', $data['ids']);
        $this->db->delete('job_filter_value_assignments');

        foreach ($values as $value) {
            $existing = $this->checkExistingJobFilterValue($value['id']);
            if ($existing) {
                $this->db->where('job_filter_value_id', $value['id']);
                $this->db->update('job_filter_values', array('title' => $value['value']));
            } else {
                $insert['job_filter_id'] = $job_filter_id;
                $insert['title'] = $value['value'];
                $this->db->insert('job_filter_values', $insert);
            }
        }
    }

    private function checkExistingJobFilterValue($id)
    {
        $this->db->where('job_filter_value_id', $id);
        $result = $this->db->get('job_filter_values');
        return $result->num_rows() > 0 ? true : false;
    }

    public function changeStatus($job_filter_id, $status)
    {
        $this->db->where('job_filter_id', $job_filter_id);
        $this->db->update('job_filters', array('status' => ($status == 1 ? 0 : 1)));
    }

    public function remove($job_filter_id)
    {
        $this->db->delete('job_filters', array('job_filter_id' => $job_filter_id));
        $this->db->delete('job_filter_values', array('job_filter_id' => $job_filter_id));
        $this->db->delete('job_filter_value_assignments', array('job_filter_id' => $job_filter_id));
    }

    public function bulkAction()
    {
        $data = objToArr(json_decode($this->xssCleanInput('data')));
        $action = $data['action'];
        $ids = $data['ids'];
        switch ($action) {
            case "activate":
                $this->db->where_in('job_filter_id', $ids);
                $this->db->update('job_filters', array('status' => 1));
            break;
            case "deactivate":
                $this->db->where_in('job_filter_id', $ids);
                $this->db->update('job_filters', array('status' => '0'));
            break;
        }
    }

    public function valueExist($field, $value, $edit = false)
    {
        $this->db->where($field, $value);
        if ($edit) {
            $this->db->where('job_filter_id !=', $edit);
        }
        $query = $this->db->get('job_filters');
        return $query->num_rows() > 0 ? true : false;
    }

    public function getAll($active = true)
    {
        $this->db->select('
            job_filters.*,
            GROUP_CONCAT(
                DISTINCT(CONCAT('.CF_DB_PREFIX.'job_filter_values.title, ")=-=(", '.CF_DB_PREFIX.'job_filter_values.job_filter_value_id))
            SEPARATOR "(=-=)") as filters
        ');
        if ($active) {
            $this->db->where('status', 1);
        }
        $this->db->join('job_filter_values', 'job_filter_values.job_filter_id = job_filters.job_filter_id', 'left');
        $this->db->from($this->table);
        $this->db->group_by('job_filters.job_filter_id');
        $this->db->order_by('job_filter_values.job_filter_value_id', 'ASC');
        $query = $this->db->get();
        $result = $query->result();
        $return = array();
        foreach ($result as $r) {
            if ($r->filters) {
                $exploded1 = explode('(=-=)', $r->filters);
                foreach ($exploded1 as $e) {
                    $exploded2 = explode(')=-=(', $e);
                    $r->values[] = array('id' => $exploded2[1], 'title' => $exploded2[0]);
                }
            } else {
                $r->values = array();
            }
            unset($r->filters);
            $return[] = $r;
        }
        return $return;
    }

    public function getAllValues($id)
    {
        $this->db->where('job_filter_id', $id);
        $this->db->from('job_filter_values');
        $query = $this->db->get();
        return $query->result();
    }

    public function job_filtersList()
    {
        $request = $this->input->post();
        $columns = array(
            "",
            "job_filters.title",
            "",
            "job_filters.order",
            "job_filters.admin_filter",
            "job_filters.front_filter",
            "job_filters.front_home_filter",
            "job_filters.front_value",
            "job_filters.type",
            "job_filters.title",
            "job_filters.created_at",
            "job_filters.status",
        );
        $orderColumn = $columns[($request['order'][0]['column'] == 0 ? 5 : $request['order'][0]['column'])];
        $orderDirection = $request['order'][0]['dir'];
        $srh = $request['search']['value'];
        $limit = $request['length'];
        $offset = $request['start'];

        $this->db->from('job_filters');
        $this->db->select('
            job_filters.*,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_filter_values.title) SEPARATOR ", ") as filter_values
        ');
        if ($srh) {
            $this->db->group_start()->like('title', $srh)->group_end();
        }
        if (isset($request['status']) && $request['status'] != '') {
            $this->db->where('job_filters.status', $request['status']);
        }
        $this->db->join('job_filter_values', 'job_filter_values.job_filter_id = job_filters.job_filter_id', 'left');
        $this->db->group_by('job_filters.job_filter_id');
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
        $this->db->from('job_filters');
        if ($srh) {
            $this->db->group_start()->like('title', $srh)->group_end();
        }
        if (isset($request['status']) && $request['status'] != '') {
            $this->db->where('job_filters.status', $request['status']);
        }
        $this->db->group_by('job_filters.job_filter_id');
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function prepareDataForTable($job_filters)
    {
        $sorted = array();
        foreach ($job_filters as $c) {
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
            if (allowedTo('edit_job_filters')) {
            $actions .= '
                <button type="button" class="btn btn-primary btn-xs create-or-edit-job-filter" data-id="'.$c['job_filter_id'].'"><i class="far fa-edit"></i></button>
                <button type="button" class="btn btn-warning btn-xs add-job-filter-values" data-id="'.$c['job_filter_id'].'" data-title="'.$c['title'].'"><i class="fas fa-list"></i></button>
            ';
            }
            if (allowedTo('delete_job_filters')) {
            $actions .= '
                <button type="button" class="btn btn-danger btn-xs delete-job-filter" data-id="'.$c['job_filter_id'].'"><i class="far fa-trash-alt"></i></button>
            ';
            }
            $sorted[] = array(
                "<input type='checkbox' class='minimal single-check' data-id='".$c['job_filter_id']."' />",
                esc_output($c['title'], 'html'),
                $c['filter_values'] ? esc_output($c['filter_values']) : '---',
                esc_output($c['order'], 'html'),
                ($c['admin_filter'] == 1 ? lang('yes') : lang('no')),
                ($c['front_filter'] == 1 ? lang('yes') : lang('no')),
                ($c['front_home_filter'] == 1 ? lang('yes') : lang('no')),
                ($c['front_value'] == 1 ? lang('yes') : lang('no')),
                ($c['type'] == 'dropdown' ? lang('dropdown') : lang('checkbox')),
                dateLang($c['created_at']),
                '<button type="button" title="'.$button_title.'" class="btn btn-'.$button_class.' btn-xs change-job-filter-status" data-status="'.$c['status'].'" data-id="'.$c['job_filter_id'].'">'.$button_text.'</button>',
                $actions
            );
        }
        return $sorted;
    }
}