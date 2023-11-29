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
 * @package    CodeIgniter
 * @author    EllisLab Dev Team
 * @copyright    Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright    Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license    https://opensource.org/licenses/MIT	MIT License
 * @link    https://codeigniter.com
 * @since    Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package        CodeIgniter
 * @subpackage    Libraries
 * @category    Libraries
 * @author        EllisLab Dev Team
 * @link        https://codeigniter.com/user_guide/general/controllers.html
 */
#[\AllowDynamicProperties]
class CI_Controller
{

    /**
     * Reference to the CI singleton
     *
     * @var    object
     */
    private static $instance;

    /**
     * Class constructor
     *
     * @return    void
     */
    public function __construct()
    {
        self::$instance =& $this;

        // Assign all the class objects that were instantiated by the
        // bootstrap file (CodeIgniter.php) to local class variables
        // so that CI can run as one big super object.
        foreach (is_loaded() as $var => $class) {
            $this->$var =& load_class($class);
        }

        $this->load =& load_class('Loader', 'core');
        $this->load->initialize();
        log_message('info', 'Controller Class Initialized');
    }

    /**
     * Get the CI singleton
     *
     * @static
     * @return    object
     */
    public static function &get_instance()
    {
        return self::$instance;
    }

    /**
     * Function to check admin/user login and redirect if not
     *
     * @return html/string
     */
    public function checkAdminLogin()
    {
        if (!$this->session->userdata('admin')) {
            redirect(base_url().'admin/login');
        }
    }

    /**
     * Function to check candidate login and redirect if not
     *
     * @return html/string
     */
    public function checkLogin()
    {
        $this->form_validation->set_message('required', lang('form_validation_required'));        
        if (!$this->session->userdata('candidate')) {
            redirect(base_url().'login');
        }
    }

    /**
     * Function to display error messages throughout application
     *
     * @param array $data
     * @return html/string
     */
    public function ajaxErrorMessage($data)
    {
        if (isAdminRoute()) {
            return $this->load->view('admin/partials/messages-3', $data, TRUE);
        } else {
            return $this->load->view('admin/partials/messages', $data, TRUE);
        }
    }

    /**
     * Function to resize and save images by set of parameters
     *
     * @param string $dir
     * @param string $name
     * @param string $ext
     * @param integer $width
     * @param string $height
     * @return void
     */
    public function resizeByWidthAndCropByHeight($dir, $name, $ext, $width, $height = 'original')
    {
        $file = $dir . $name . '.' . $ext;
        $newFile = $dir . $name . '-' . $width . '-' . $height . '.' . $ext;

        //First resize with maintained aspect ratio
        $im = new ImageManipulator($file);
        $im->resample($width, 0);
        $im->save($newFile);

        if ($height != 'original') {
            //Second Crop vertically with the above resized width
            $im = new ImageManipulator($newFile);
            $centreX = round($im->getWidth() / 2);
            $centreY = round($im->getHeight() / 2);
            $width = ($width / 2);
            $height = $height == 'original' ? ($im->getHeight() / 2) : ($height / 2);

            $x1 = $centreX - ($width);
            $y1 = $centreY - ($height);

            $x2 = $centreX + ($width);
            $y2 = $centreY + ($height);

            $im->crop($x1, $y1, $x2, $y2);
            $im->save($newFile);
        }
    }

    /**
     * Function to resize and save images by set of parameters
     *
     * @param string $dir
     * @param string $name
     * @param string $ext
     * @param integer $width
     * @param string $height
     * @return void
     */
    public function resizeByWidthOrHeight($dir, $key, $name, $ext, $width = 0, $height = 0)
    {
        $file = $dir . $name . '.' . $ext;
        $newFile = $dir . $key . '.' . $ext;
        $im = new ImageManipulator($file);
        $im->resize($width, $height);
        $im->save($newFile);
    }

    /**
     * Function to display links for pagination
     *
     * @param integer $page
     * @param string $url
     * @param integer $total
     * @param integer $total
     * @param integer $pageSlug
     * @return html/string
     */
    public function createPagination($page, $url, $total, $perPage)
    {
        $config['base_url'] = base_url().$url;
        $config["cur_page"] = $page;
        $config['total_rows'] = $total;
        $config['per_page'] = $perPage;
        $config['num_links'] = 5;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['reuse_query_string'] = true;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = '&laquo;';
        $config['prev_link'] = '&lsaquo;';
        $config['last_link'] = '<span aria-hidden="true">&raquo;</span>';
        $config['next_link'] = '<span aria-hidden="true">&rsaquo;</span>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }    

    /**
     * Function to get google client for google login
     *
     * @return Google_Client
     */
    public function getGoogleClient()
    {
        // init configuration
        $clientID = setting('google-client-id');
        $clientSecret = setting('google-client-secret');
        $redirectUri = base_url() . 'google-redirect';

        // create Client Request to access Google API
        $client = new Google_Client();
        $client->setClientId($clientID);
        $client->setClientSecret($clientSecret);
        $client->setRedirectUri($redirectUri);
        $client->addScope("email");
        $client->addScope("profile");

        return $client;
    }

    /**
     * Global function to send email
     *
     * @return void
     */
    public function sendEmail($message = '', $toEmail = '', $subject = '')
    {
        $this->load->library('email');
        if (setting('smtp') == 'yes' && setting('smtp-username') != '') {
            $protocol = setting('smtp-protocol') ? setting('smtp-protocol') : 'ssl';
            $this->email->initialize(array(
                'protocol' => 'smtp',
                'smtp_crypto' => $protocol,
                'smtp_host' => setting('smtp-host'),
                'smtp_user' => setting('smtp-username'),
                'smtp_pass' => setting('smtp-password'),
                'smtp_port' => setting('smtp-port'),
                'crlf' => "\r\n",
                'newline' => "\r\n",
                'charset' => 'utf-8'
            ));
        }

        $this->email->set_mailtype("html");
        $this->email->from(setting('from-email'), setting('site-name'));
        $this->email->message($message);
        $this->email->to($toEmail);
        $this->email->subject(setting('site-name').' : '.$subject);
        $this->email->send();
    }

    /**
     * Global function to restrict actions if in demo mode
     *
     * @return void
     */
    public function checkIfDemo($type = '')
    {
        if (CF_DEMO) {
            $message = 'Action restricted in demo mode';
            if ($type == 'reload') {
                die($message);
            } elseif ($type == 'front') {
                $message = $this->load->view('themes/dark/partials/messages', array('error' => 'Action restricted in demo mode'), TRUE);
                echo json_encode(array(
                    'status' => 'error',
                    'message' => $message
                ));
                die();
            } else {
                echo json_encode(array(
                    'success' => 'false',
                    'messages' => $this->ajaxErrorMessage(array('error' => $message))
                ));
                die();
            }
        }
        $this->setValidationMessageLang();
    }

    public function sess($name, $default = '')
    {   
        return $this->session->userdata($name) ? $this->session->userdata($name) : $default;
    }

    public function xssCleanInput($name = '', $type = '')
    {
        if ($type == 'get') {
            $input = $name ? $this->input->get($name) : $this->input->get();
        } else {
            $input = $name ? $this->input->post($name) : $this->input->post();    
        }
        return $input ? $this->security->xss_clean($input) : '';
    }

    /**
     * Function to display admin languages
     *
     * @return void
     */
    public function languageSelect($type = 'admin')
    {   
        $data['languages'] = objToArr($this->AdminLanguageModel->getAll());
        if ($type == 'admin') {
            return $this->load->view('admin/partials/language-select', $data, true);
        } else {
            return $this->load->view('front/'.viewPrfx().'/partials/language-select', $data, true);
        }
    }

    private function setValidationMessageLang()
    {
        $validations = array(
            'required',
            'isset',
            'valid_email',
            'valid_emails',
            'valid_url',
            'valid_ip',
            'valid_base64',
            'min_length',
            'max_length',
            'exact_length',
            'alpha',
            'alpha_numeric',
            'alpha_numeric_spaces',
            'alpha_dash',
            'numeric',
            'is_numeric',
            'integer',
            'regex_match',
            'matches',
            'differs',
            'is_unique',
            'is_natural',
            'is_natural_no_zero',
            'decimal',
            'less_than',
            'less_than_equal_to',
            'greater_than',
            'greater_than_equal_to',
            'error_message_not_set',
            'in_list',
        );
        foreach ($validations as $v) {
            $this->form_validation->set_message($v, lang('form_validation_'.$v));
        }
    }
}
