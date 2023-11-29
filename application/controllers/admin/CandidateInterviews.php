<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CandidateInterviews extends CI_Controller
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
     * View Function to display candidateInterviews list view page
     *
     * @return html/string
     */
    public function listView()
    {
        $data['page'] = lang('candidate_interviews');
        $data['menu'] = 'candidate_interviews';
        $data['users'] = objToArr($this->AdminUserModel->getAll());
        $data['jobs'] = objToArr($this->AdminJobModel->getAll());
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/candidate-interviews/list');
    }

    /**
     * Function to get data for candidateInterviews jquery datatable
     *
     * @return json
     */
    public function data()
    {
        $this->checkAdminLogin();
        echo json_encode($this->AdminCandidateInterviewModel->candidateInterviewsList());
    }    

    /**
     * View Function (for ajax) to display view or conduct view page via modal
     *
     * @param integer $candidate_interview_id
     * @return html/string
     */
    public function viewOrConduct($candidate_interview_id = NULL)
    {
        $candidate_interview = $this->AdminCandidateInterviewModel->getCandidateInterview(
            'candidate_interview_id', $candidate_interview_id
        );
        echo $this->load->view('admin/candidate-interviews/edit', compact('candidate_interview'), TRUE);
    }

    /**
     * Function (for ajax) to process candidate_interview create or edit form request
     *
     * @return redirect
     */
    public function save()
    {
        $this->checkIfDemo();
        $data = $this->AdminCandidateInterviewModel->storeCandidateInterview();
        $this->AdminJobBoardModel->updateInterviewResultInJobApplication($data);
        $this->AdminJobBoardModel->updateOverallResultInJobApplication($data);
        echo json_encode(array(
            'success' => 'true',
            'messages' => $this->ajaxErrorMessage(array('success' => lang('candidate_interview_recorded')))
        ));
    }

    /**
     * Function (for ajax) to display form to send email to candidate
     *
     * @return void
     */
    public function messageView()
    {
        echo $this->load->view('admin/candidates/message', array(), TRUE);
    }

    /**
     * Function (for ajax) to send email to candidate
     *
     * @return void
     */
    public function message()
    {
        ini_set('max_execution_time', 5000);
        $data = $this->xssCleanInput();
        $candidates = explode(',', $data['ids']);

        $this->checkIfDemo();
        $this->form_validation->set_rules('email', lang('message'), 'min_length[10]|max_length[5000]');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
            exit;
        }

        foreach ($candidates as $candidate_id) {
            $candidate = objToArr($this->AdminCandidateModel->getCandidate('candidate_id', $candidate_id));
            $msg = $data['msg'];
            $message = $this->load->view('admin/emails/candidate-email', compact('candidate', 'msg'), TRUE);
            $this->sendEmail($message, $candidate['email'], lang('notification'));
        }

        echo json_encode(array(
            'success' => 'true',
            'messages' => ''
        ));
    }    
}
