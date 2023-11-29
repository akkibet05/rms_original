<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

use SimpleExcel\SimpleExcel;
use Dompdf\Dompdf;
use Dompdf\Options;

class Candidates extends CI_Controller
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
     * View Function to display candidates list view page
     *
     * @return html/string
     */
    public function listView()
    {
        $data['page'] = lang('candidates');
        $data['menu'] = 'candidates';
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/candidates/list');
    }

    /**
     * Function to get data for candidates jquery datatable
     *
     * @return json
     */
    public function data()
    {
        echo json_encode($this->AdminCandidateModel->candidatesList());
    }    

    /**
     * View Function (for ajax) to display create or edit view page via modal
     *
     * @param integer $candidate_id
     * @return html/string
     */
    public function createOrEdit($candidate_id = NULL)
    {
        $candidate = objToArr($this->AdminCandidateModel->getCandidate('candidate_id', $candidate_id));
        echo $this->load->view('admin/candidates/create-or-edit', compact('candidate'), TRUE);
    }

    /**
     * Function (for ajax) to process candidate create or edit form request
     *
     * @return redirect
     */
    public function saveCandidate()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('first_name', lang('first_name'), 'trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('last_name', lang('last_name'), 'trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('email', lang('email'), 'required|min_length[2]|max_length[50]|valid_email');

        $edit = $this->xssCleanInput('candidate_id') ? $this->xssCleanInput('candidate_id') : false;
        $imageUpload = $this->uploadImage($edit);
        if (!$edit) {
            $this->form_validation->set_rules('password', lang('password'), 'required');
        }

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } elseif ($this->AdminCandidateModel->valueExist('email', $this->xssCleanInput('email'), $edit)) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('email_already_exist')))
            ));
        } elseif ($imageUpload['success'] == 'false') {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => $imageUpload['message']))
            ));
        } else {
            $this->AdminCandidateModel->storeCandidate($edit, $imageUpload['message']);
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('candidate').' ' . ($edit ? lang('updated') : lang('created'))))
            ));
        }
    }

    /**
     * Private function to upload candidate image if any
     *
     * @param integer $edit
     * @return array
     */
    private function uploadImage($edit = false)
    {
        if ($_FILES['image']['name'] != '') {
            if ($edit) {
                $candidate = objToArr($this->AdminCandidateModel->getCandidate('candidate_id', $edit));
                if ($candidate['image']) {
                    @unlink(ASSET_ROOT . '/images/candidates/' . $candidate['image']);
                }
            }
            $file = explode('.', $_FILES['image']['name']);
            $filename = url_title(convert_accented_characters($_FILES['image']['name']), 'dash', true);
            $filename .= '-' . strtotime(date('Y-m-d G:i:s'));
            $config['upload_path'] = ASSET_ROOT . '/images/candidates/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = $filename;
            $config['max_size'] = uploadLimit(1024);
            $config['max_width'] = '400';
            $config['max_height'] = '400';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                return array(
                    'success' => 'false',
                    'message' => uploadImageError(uploadLimit(1024), lang('only_image_allowed_400'))
                );
            } else {
                $data = $this->upload->data();
                return array('success' => 'true', 'message' => $data['file_name']);
            }
        }
        return array('success' => 'true', 'message' => '');
    }

    /**
     * Function (for ajax) to process candidate change status request
     *
     * @param integer $candidate_id
     * @param string $status
     * @return void
     */
    public function changeStatus($candidate_id = null, $status = null)
    {
        $this->checkIfDemo();
        $this->AdminCandidateModel->changeStatus($candidate_id, $status);
    }

    /**
     * Function (for ajax) to process candidate bulk action request
     *
     * @return void
     */
    public function bulkAction()
    {
        $this->checkIfDemo();
        $this->AdminCandidateModel->bulkAction();
    }

    /**
     * Function (for ajax) to process candidate delete request
     *
     * @param integer $candidate_id
     * @return void
     */
    public function delete($candidate_id)
    {
        $this->checkIfDemo();
        $this->AdminCandidateModel->remove($candidate_id);
    }

    /**
     * Function (for ajax) to display candidate resume
     *
     * @param integer $candidate_id
     * @return void
     */
    public function resume($candidate_id)
    {
        $resume = $this->AdminCandidateModel->getCompleteResume($candidate_id);
        if ($resume) {
            $data['resume_id'] = $resume['resume_id'];
            $data['resume_file'] = $resume['file'];
            $data['type'] = $resume['type'];
            $data['file'] = $resume['file'];
            $data['resume'] = $resume;
            echo $this->load->view('admin/candidates/resume', $data, TRUE);
        } else {
            echo lang('no_resumes_found');
        }
    }

    /**
     * Post Function to download candidate resume
     *
     * @return void
     */
    public function resumeDownload()
    {
        ini_set('max_execution_time', '0');
        $this->checkAdminLogin();
        $ids = explode(',', $this->xssCleanInput('ids'));
        $resumes = '';
        $title = '-resume.pdf';
        foreach ($ids as $id) {
            $data['resume'] = $this->AdminCandidateModel->getCompleteResumeJobBoard($id);
            $title = $data['resume']['first_name'].'-'.$data['resume']['last_name'].$title;
            if ($data['resume']['type'] == 'detailed') {
                $resumes .= $this->load->view('admin/candidates/resume-pdf', $data, TRUE);
            } else {
                $resumes .= "<hr />";
                $resumes .= 'Resume of "'.$data['resume']['first_name'].' '.$data['resume']['last_name'].' ('.$data['resume']['designation'].')" is static and can be downloaded separately';
                $resumes .= "<br /><hr />";
            }
            
        }        

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($resumes);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream($title);
        exit;
    }

    /**
     * Post Function to download candidates data in excel
     *
     * @return void
     */
    public function candidatesExcel()
    {
        $data = $this->AdminCandidateModel->getCandidatesForCSV($this->xssCleanInput('ids'));
        $data = sortForCSV(objToArr($data));
        $excel = new SimpleExcel('csv');                    
        $excel->writer->setData($data);
        $excel->writer->saveFile('candidates'); 
        exit;
    }
}
