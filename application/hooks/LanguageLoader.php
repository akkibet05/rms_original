<?php

class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        $language = '';

        if ($ci->db->table_exists('languages') && !defined('CODEIGNITER_EXTERNAL_ACCESS')) {

            $ci->load->helper('language');
            $ci->load->library('session');
            $default = objToArr($ci->AdminLanguageModel->getDefault());
            
            if (strpos(current_url(), 'admin') !== false && $ci->session->userdata('admin_language')) {
                $language = $ci->session->userdata('admin_language');
            } elseif (strpos(current_url(), 'admin') != true && $ci->session->userdata('candidate_language')) {
                $language = $ci->session->userdata('candidate_language');
            } else {
                if (strpos(current_url(), 'admin') !== false) {
                    $ci->session->set_userdata('admin_language',  issetVal($default, 'slug'));
                    $ci->session->set_userdata('admin_language_dir',  issetVal($default, 'direction'));
                    $language = issetVal($default, 'slug');
                } else {
                    $ci->session->set_userdata('candidate_language',  issetVal($default, 'slug'));
                    $ci->session->set_userdata('candidate_language_dir',  issetVal($default, 'direction'));
                    $language = issetVal($default, 'slug');
                }
            }
        }

        //Checking if file exists.
        $file_path = substr(__DIR__, 0, -5).'language/'.$language.'/message_lang.php';
        if (!file_exists($file_path)) {
            $language = 'english';
        }

        $ci->lang->load('message', $language);
    }
}