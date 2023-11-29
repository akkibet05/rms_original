<?php

class Pages extends CI_Controller
{
    /**
     * View Function to display home page
     *
     * @return html/string
     */
    public function index()
    {
        $default = setting('default-landing-page');
        if ($default == 'home') {
            $data['page'] = setting('site-name');
            $data['departments'] = $this->DepartmentModel->getAll(true, 'home');
            $data['blogs'] = $this->BlogModel->getPostsHome();
            $data['job_filters'] = $this->JobFilterModel->getAll(true, true);
            $this->load->view('front/'.viewPrfx().'/layout/header', $data);
            $this->load->view('front/'.viewPrfx().'/home');
        } else if ($default == 'jobs') {
            redirect('jobs');
        } else if ($default == 'news') {
            redirect('blogs');
        }
    }

    /**
     * View Function to display blog listing page
     *
     * @return html/string
     */
    public function blogListing($page = null)
    {
        $search = urldecode($this->xssCleanInput('search', 'get'));
        $categories = $this->xssCleanInput('categories', 'get');
        $limit = setting('blogs-limit');

        $pageData['page'] = lang('blogs').' | ' . setting('site-name');
        $data['blogs'] = $this->BlogModel->getAll($page, $search, $categories, $limit);
        $data['categories'] = $this->BlogModel->getCategories();
        $data['pagination'] = $this->getPagination($page, $search, $categories, $limit);
        $data['page'] = 'profile';
        $data['search'] = $search;
        $data['categoriesSel'] = $categories;
        $data['breadcrumb_title'] = lang('blogs');
        $data['breadcrumb_page'] = 'blogs';
        $this->load->view('front/'.viewPrfx().'/layout/header', $pageData);
        $this->load->view('front/'.viewPrfx().'/blog-listing', $data);
    }

    /**
     * View Function to display blog listing page
     *
     * @return html/string
     */
    public function blogDetail($id = null)
    {
        $search = urldecode($this->xssCleanInput('search', 'get'));
        $categories = $this->xssCleanInput('categories', 'get');

        $data['blog'] = $this->BlogModel->getBlog('blogs.blog_id', decode($id));
        $data['image'] = $data['blog']['image'] ?  base_url().'assets/images/blogs/'.$data['blog']['image'] : base_url().'assets/images/news-not-found.png';
        $data['categories'] = $this->BlogModel->getCategories();
        $data['search'] = $search;
        $data['categoriesSel'] = $categories;
        $pageData['page'] = $data['blog']['title'].' | ' . setting('site-name');
        $this->load->view('front/'.viewPrfx().'/layout/header', $pageData);
        $this->load->view('front/'.viewPrfx().'/blog-detail', $data);
    }

    /**
     * Private function to create pagination for blogs listing
     *
     * @return html/string
     */
    private function getPagination($page, $search, $categories, $perPage)
    {
        $total = $this->BlogModel->getTotal($search, $categories);
        $url = '/blogs/';
        return $this->createPagination($page, $url, $total, $perPage);
    }    

    /**
     * Post function to create schema and import data during installation
     *
     * @return void
     */
    public function createSchemaAndImportData($import_data = false)
    {   
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('max_execution_time', 1000);
        try {
            $this->SchemaModel->run();
            $this->SchemaQuestionsModel->run();
            if ($import_data) {
                $this->DataQuestionsModel->run();
                $this->DataModel->run();
            }
            $message = 'success';
        } catch (Exception $e) {
            $message = $e->getMessage();
        }
        return $message;
    }

    /**
     * Function (for ajax) to create admin user form request (from installation)
     *
     * @return redirect
     */
    public function createAdminUser($data = array())
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'required|min_length[2]|max_length[20]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|min_length[2]|max_length[20]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('retype_password', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() === FALSE) {
            return validation_errors();
        } elseif ($this->AdminUserModel->existingAdminUser()) {
            return 'Admin User Already exists';
        } else {
            $this->AdminUserModel->storeAdminUser($data);
            return 'success';
        }
    }    

    /**
     * Function to save session variable for sidebar goggle
     *
     * @return void
     */
    public function sidebarToggle()
    {
        $currentValue = $this->sess('sidebar-toggle');
        $currentValue = $currentValue == 'off' ? 'on' : 'off';
        $this->session->set_userdata('sidebar-toggle', $currentValue);
    }

    /**
     * Function (for ajax) to set language via the selector for front site
     *
     * @param integer $language_slug
     * @return void
     */
    public function setLanguage($language_slug = null, $direction = null)
    {
        $language = $this->AdminLanguageModel->getLanguage('languages.slug', $language_slug);
        $this->session->set_userdata('candidate_language_dir', $direction);
        $this->session->set_userdata('candidate_language_flag', $language->flag);
        $this->session->set_userdata('candidate_language',  $language_slug);
        updateLangVariables($language_slug, 'front');
    }

    /**
     * Function (for ajax) to set color
     *
     * @param integer $color
     * @return void
     */
    public function setColor($color = null)
    {
        $this->session->set_userdata('selected_color_theme',  $color);
    }

    /**
     * Function to display default 404 page on 404 error
     *
     * @return void
     */
    public function notFoundPage()
    {   
        $data['page'] = setting('site-name').' | page not found';
        $this->load->view('front/'.viewPrfx().'/layout/header', $data);
        $this->load->view('front/'.viewPrfx().'/404');
    }

}
