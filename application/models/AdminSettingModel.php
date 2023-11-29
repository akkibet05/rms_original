<?php

class AdminSettingModel extends CI_Model
{
    protected $table = 'settings';
    protected $key = 'setting_id';

    public function getSetting($column, $value)
    {
        $this->db->where($column, $value);
        $this->db->where('status', 1);
        $result = $this->db->get('settings');
        return ($result->num_rows() == 1) ? objToArr($result->row(0)) : $this->emptyObject('settings');
    }

    public function getSettingsByCategory($category)
    {
        $this->db->where('category', $category);
        $this->db->order_by('setting_id', 'ASC');
        $this->db->from($this->table);
        $query = $this->db->get();
        return objToArr($query->result());
    }

    public function updateSetting($data)
    {
        foreach ($data as $k => $d) {
            $d = removeUselessLineBreaks($d);
            $this->db->where('key', $k);
            $this->db->update('settings', array('value' => $d));
        }
    }

    public function updateCssVariables($data)
    {
        $existing = array(
            'body-bg' => setting('body-bg'),
            'main-menu-bg' => setting('main-menu-bg'),
            'main-banner-bg' => setting('main-banner-bg'),
            'main-banner-height' => setting('main-banner-height'),
            'breadcrumb-image' => setting('breadcrumb-image'),
            'main-banner' => setting('main-banner'),
        );
        $updated = array();
        foreach ($existing as $key => $val) {
            if (issetVal($data, $key)) {
                $updated[$key] = $data[$key];
            } else {
                $updated[$key] = '';
            }
        }

        $cssVars = ":root {\n";
        foreach ($updated as $key => $value) {
            $cssVars .= '--'.$key.':'.$this->addUrlForCss($key, $value).";\n";
        }
        $cssVars .= "}";

        //Writing to file and update in db setting
        $variable_file_path = FCPATH.'/assets/front/'.viewPrfx(true).'/css/variables.css';
        writeToFile($variable_file_path, $cssVars);
    }

    private function addUrlToAssets($key, $val)
    {
        if ($key == 'main-banner' || $key == 'breadcrumb-image' && !str_contains('http', )) {
            return base_url().'assets/images/identities/'.$val;
        } else {
            return $val;
        }
        return $val;
    }

    private function addUrlForCss($key, $val)
    {
        if ($key == 'main-banner' || $key == 'breadcrumb-image') {
            return 'url('.base_url().'assets/images/identities/'.setting('main-banner').')';
        } else {
            return $val;
        }
    }

}