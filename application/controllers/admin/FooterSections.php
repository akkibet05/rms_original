<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FooterSections extends CI_Controller
{
    /**
     * Constructor
     * 
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->checkAdminLogin();
    }

    /**
     * View Function For the overall page of quiz designer
     *
     * @return html/string
     */
    public function index()
    {
        $header['page'] = lang('footer_sections');
        $header['menu'] = 'footer_sections';
        $data['sections'] = $this->AdminFooterSectionModel->getAll();
        $this->load->view('admin/layout/header', $header);
        $this->load->view('admin/footer-sections/edit', $data);
    }

    /**
     * Function (for ajax) to process create or edit form request
     *
     * @return redirect
     */
    public function save()
    {
        $this->checkIfDemo();
        $data = $this->AdminFooterSectionModel->store();
        echo json_encode(array(
            'success' => 'true',
            'messages' => $this->ajaxErrorMessage(array('success' => lang('sections_updated'))),
        ));
    }    
}
