<?php

class SettingModel extends CI_Model
{
    protected $table = 'settings';
    protected $key = 'setting_id';

    public function getAll()
    {
        $this->db->from($this->table);
        $query = $this->db->get();
        return $this->sortByCategory($query->result());
    }

    public function store($key = '', $value = '')
    {
        $data = objToArr(json_decode($this->xssCleanInput('data')));

        $key = $key ? $key : $data['key'];
        $value = $value ? $value : $data['value'];
        $value = str_replace('"', "'", $value);
        $this->db->where('key', $key);
        return $this->db->update($this->table, ['value' => $value]);
    }

    public function getForAdmin($sorted = true)
    {
        $this->db->from($this->table);
        $this->db->where('user_id', 0);
        $query = $this->db->get();
        if ($sorted) {
            return $this->sortUserSetting(objToArr($query->result()));
        } else {
            return objToArr($query->result());
        }
    }

    private function sortUserSetting($settings)
    {
        $sorted = array();
        foreach ($settings as $s) {
            $sorted[$s['key']] = $s['value'];
        }
        return $sorted;
    }

    private function sortByCategory($settings)
    {
        $sorted = array();
        foreach ($settings as $s) {
            $sorted[$s->category][] = $s;
        }
        return $sorted;
    }
}