<?php

class AdminFooterSectionModel extends CI_Model
{
    protected $table = 'footer_sections';
    protected $key = 'footer_section_id';

    public function store()
    {
        $data = $this->xssCleanInput();
        $data = arrangeSections(array('footer_section_id' => $data['column'], 'content' => $data['content']));

        foreach ($data as $key => $value) {
            $this->db->where('footer_section_id', $value['footer_section_id']);
            $value['updated_at'] = date('Y-m-d G:i:s');
            $value['content'] = removeUselessLineBreaks($value['content']);
            $this->db->update('footer_sections', $value);
        }
    }

    public function getAll($content = '')
    {
        if ($content == 'columns') {
        $this->db->where('content !=', '');
        $this->db->where('footer_section_id !=', '5');
        }
        if ($content == 'bottom') {
        $this->db->where('content !=', '');
        $this->db->where('footer_section_id', '5');
        }
        $this->db->from($this->table);
        $query = $this->db->get();
        return objToArr($query->result());
    }

}
