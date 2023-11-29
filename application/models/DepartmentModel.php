<?php

class DepartmentModel extends CI_Model
{
    protected $table = 'departments';
    protected $key = 'department_id';

    public function getDepartment($column, $value)
    {
        $this->db->where($column, $value);
        $result = $this->db->get('departments');
        return ($result->num_rows() == 1) ? $result->row(0) : $this->emptyObject('departments');
    }

    public function getAll($active = true, $for = 'home')
    {
        $limit = $for == 'home' ? setting('departments-home-limit') : setting('departments-filters-limit');
        $this->db->select('
            departments.*,
            COUNT('.CF_DB_PREFIX.'jobs.department_id) as jobs_count,
        ');
        if ($active) {
            $this->db->where('departments.status', 1);
        }
        $this->db->join('jobs', 'jobs.department_id = departments.department_id', 'left');
        $this->db->from($this->table);
        $this->db->limit($limit, 0);
        $this->db->group_by('departments.department_id');
        $query = $this->db->get();
        return objToArr($query->result());
    }
}