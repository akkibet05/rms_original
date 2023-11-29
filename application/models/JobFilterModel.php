<?php

class JobFilterModel extends CI_Model
{
    protected $table = 'job_filters';
    protected $key = 'job_filter_id';

    public function getAll($active = true, $front = false, $list_page = false)
    {
        $this->db->select('
            job_filters.*,
            GROUP_CONCAT(
                DISTINCT(CONCAT('.CF_DB_PREFIX.'job_filter_values.title, ")=-=(", '.CF_DB_PREFIX.'job_filter_values.job_filter_value_id))
            SEPARATOR "(=-=)") as filters
        ');
        if ($active) {
            $this->db->where('job_filters.status', 1);
        }
        if ($front) {
            $this->db->where('job_filters.front_home_filter', 1);
        }
        if ($list_page) {
            $this->db->where('job_filters.front_filter', 1);
        }
        $this->db->join('job_filter_values', 'job_filter_values.job_filter_id = job_filters.job_filter_id', 'left');
        $this->db->from($this->table);
        $this->db->group_by('job_filters.job_filter_id');
        $this->db->order_by('job_filters.order', 'ASC');
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
        return objToArr($return);
    }

    public function getAllSimple($active = true, $front_filter = true)
    {
        $this->db->select('
            job_filters.*,
        ');
        $this->db->from($this->table);
        $query = $this->db->get();
        $result = $query->result();
        $return = array();
        foreach ($result as $r) {
            $return[$r->job_filter_id] = array(
                'admin_filter' => $r->admin_filter,
                'front_filter' => $r->front_filter,
                'front_value' => $r->front_value,
                'status' => $r->status,
            );
        }
        return $return;
    }
}