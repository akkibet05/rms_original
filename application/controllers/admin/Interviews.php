<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

use SimpleExcel\SimpleExcel;
use Dompdf\Dompdf;

class Interviews extends CI_Controller
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
     * View Function (for ajax) to display create or edit view page via modal
     *
     * @param integer $interview_id
     * @return html/string
     */
    public function createOrEdit($interview_id = NULL)
    {
        $data['interview'] = objToArr($this->AdminInterviewModel->get('interview_id', $interview_id));
        $data['interview_categories'] = $this->AdminInterviewCategoryModel->getAll();
        echo $this->load->view('admin/interviews/create-or-edit', $data, TRUE);
    }

    /**
     * Function (for ajax) to process interview create or edit form request
     *
     * @return redirect
     */
    public function save()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('title', lang('title'), 'required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('description', lang('description'), 'required|min_length[10]|max_length[2500]');

        $edit = $this->xssCleanInput('interview_id') ? $this->xssCleanInput('interview_id') : false;

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } elseif ($this->AdminInterviewModel->valueExist('title', $this->xssCleanInput('title'), $edit)) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('interview_already_exist')))
            ));
        } else {
            $result = $this->AdminInterviewModel->store($edit);
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('interview') . ($edit ? lang('updated') : lang('created')))),
                'data' => $result
            ));
        }
    }

    /**
     * Function (for ajax) to process interview delete request
     *
     * @param integer $interview_id
     * @return void
     */
    public function delete($interview_id)
    {
        $this->checkIfDemo();
        $this->AdminInterviewModel->remove($interview_id);
    }

    /**
     * View Function (for ajax) to return interview dropdown list
     *
     * @param integer $interview_category_id
     * @return html/string
     */
    public function dropdown($interview_category_id = NULL)
    {
        echo json_encode($this->AdminInterviewModel->getDropDown($interview_category_id));
    }   

    /**
     * View Function (for ajax) to display clone form page via modal
     *
     * @param integer $interview_id
     * @return html/string
     */
    public function cloneForm($interview_id = NULL)
    {
        if ($interview_id != '0') {
            $data['interview'] = objToArr($this->AdminInterviewModel->get('interview_id', $interview_id));
            $data['interview_categories'] = $this->AdminInterviewCategoryModel->getAll();
            echo $this->load->view('admin/interviews/clone', $data, TRUE);
        } else {
            echo $this->load->view('admin/interviews/no-interview', array(), TRUE);
        }
    }

    /**
     * Function (for ajax) to process interview clone form request
     *
     * @return redirect
     */
    public function cloneInterview()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('title', lang('title'), 'required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('description', lang('description'), 'required|min_length[10]|max_length[2500]');

        $edit = $this->xssCleanInput('interview_id') ? $this->xssCleanInput('interview_id') : false;

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } elseif ($this->AdminInterviewModel->valueExist('title', $this->xssCleanInput('title'), $edit)) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('interview_already_exist')))
            ));
        } else {
            $result = $this->AdminInterviewModel->cloneInterview($edit);
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('interview_cloned'))),
                'data' => $result
            ));
        }
    }

    /**
     * Post Function to download interview
     *
     * @param integer $interview_id
     * @return void
     */
    public function download($interview_id = NULL)
    {
        $result = $this->AdminInterviewModel->getCompleteInterview($interview_id);
        $interview = $this->load->view('admin/interviews/interview-pdf', $result, TRUE);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($interview);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('interview.pdf');
        exit;
    }
}
