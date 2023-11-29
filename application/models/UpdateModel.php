<?php

class UpdateModel extends CI_Model
{
    protected $table = 'updates';
    protected $key = 'update_id';

    public function getCurrent()
    {
        $this->db->where('updates.is_current', 1);
        $this->db->select('updates.*');
        $result = $this->db->get($this->table);
        return ($result->num_rows() == 1) ? objToArr($result->row(0)) : array();
    }

    public function getAll()
    {
        $this->db->from($this->table);
        $this->db->order_by('update_id', 'DESC');
        $query = $this->db->get();
        return objToArr($query->result());
    }

    public function store($data)
    {
        //First updating all updates to non current
        $this->db->update('updates', array('is_current' => 0));

        $data['created_at'] = date('Y-m-d G:i:s');
        $this->db->insert('updates', $data);
    }
}