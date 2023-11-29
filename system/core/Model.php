<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package CodeIgniter
 * @author  EllisLab Dev Team
 * @copyright   Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright   Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://codeigniter.com
 * @since   Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model Class
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category    Libraries
 * @author      EllisLab Dev Team
 * @link        https://codeigniter.com/user_guide/libraries/config.html
 */
class CI_Model {

    /**
     * Class constructor
     *
     * @link    https://github.com/bcit-ci/CodeIgniter/issues/5332
     * @return  void
     */
    public function __construct() 
    {
        //This is needed to be set before all queries when sql mode on some hostings is set to "only_full_group_by"
        $this->db->query('SET SESSION sql_mode = ""');        
        $this->db->query('SET SQL_BIG_SELECTS = 1');        
    }

    /**
     * __get magic
     *
     * Allows models to access CI's loaded classes using the same
     * syntax as controllers.
     *
     * @param   string  $key
     */
    public function __get($key)
    {
        // Debugging note:
        //  If you're here because you're getting an error message
        //  saying 'Undefined Property: system/core/Model.php', it's
        //  most likely a typo in your model code.
        return get_instance()->$key;
    }

    public function emptyObject($table, $extraFields = [])
    {
        $array = keyedArray($this->db->list_fields($table));
        return array_merge($array, $extraFields);
    }

    public function uniqueSlug($table, $string, $field_name = 'slug')
    {
        $slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($string)));
        $this->db->from($table);
        $this->db->like($field_name, $slug);
        $count = $this->db->get()->num_rows();
        return ($count > 1) ? ($slug . '-' . $count) : $slug;
    }

    public function setSessionValues()
    {
        $data = $this->xssCleanInput();
        foreach ($data as $name => $value) {
            $this->session->set_userdata($name, $value);
        }
    }

    public function getSessionValues($name, $default = '')
    {
        return ($this->session->userdata($name) ? $this->session->userdata($name) : $default);
    }

    public function xssCleanInput($name = '')
    {
        $input = $name ? $this->input->post($name) : $this->input->post();
        return $this->security->xss_clean($input);
    }
}
