<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

use SimpleExcel\SimpleExcel;

class Jobs extends CI_Controller
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
     * View Function to display jobs list view page
     *
     * @return html/string
     */
    public function listView()
    {
        $data['page'] = lang('jobs');
        $data['menu'] = 'jobs';
        $pagedata['companies'] = objToArr($this->AdminCompanyModel->getAll());
        $pagedata['departments'] = objToArr($this->AdminDepartmentModel->getAll());
        $pagedata['job_filters'] = objToArr($this->AdminJobFilterModel->getAll());
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/jobs/list', $pagedata);
    }

    /**
     * Function to get data for jobs jquery datatable
     *
     * @return json
     */
    public function data()
    {
        echo json_encode($this->AdminJobModel->jobsList());
    }    

    /**
     * View Function (for ajax) to display create or edit job
     *
     * @param integer $job_id
     * @return html/string
     */
    public function createOrEdit($job_id = NULL)
    {
        $pagedata['job'] = objToArr($this->AdminJobModel->getJob('jobs.job_id', decode($job_id)));
        $pagedata['companies'] = objToArr($this->AdminCompanyModel->getAll());
        $pagedata['departments'] = objToArr($this->AdminDepartmentModel->getAll());
        $pagedata['traits'] = objToArr($this->AdminTraitModel->getAll());
        $pagedata['fields'] = objToArr($this->AdminJobModel->getFields($job_id));
        $pagedata['quizes'] = objToArr($this->AdminQuizModel->getAll());
        $pagedata['job_filters'] = objToArr($this->AdminJobFilterModel->getAll());
        $data['page'] = lang('job');
        $data['menu'] = 'job';
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/jobs/create-or-edit', $pagedata);
    }

    /**
     * Function (for ajax) to process job create or edit form request
     *
     * @return redirect
     */
    public function save()
    {
        $this->checkIfDemo();
        $min_salary = $this->xssCleanInput('min_salary');
        $this->form_validation->set_rules('title', lang('title'), 'trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('description', lang('description'), 'required|min_length[50]|max_length[10000]');
        $this->form_validation->set_rules('max_salary', lang('min_salary'), 'greater_than['.$min_salary.']');
        $this->form_validation->set_rules('labels[]', lang('labels'), 'max_length[50]');
        $this->form_validation->set_rules('values[]', lang('values'), 'max_length[200]');

        $edit = $this->xssCleanInput('job_id') ? $this->xssCleanInput('job_id') : false;

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } else {
            $this->AdminJobModel->storeJob($edit);
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('job') . ($edit ? lang('updated') : lang('created'))))
            ));
        }
    }

    /**
     * Function (for ajax) to process job change status request
     *
     * @param integer $job_id
     * @param string $status
     * @return void
     */
    public function changeStatus($job_id = null, $status = null)
    {
        $this->checkIfDemo();
        $this->AdminJobModel->changeStatus($job_id, $status);
    }

    /**
     * Function (for ajax) to process job bulk action request
     *
     * @return void
     */
    public function bulkAction()
    {
        $this->checkIfDemo();
        $this->AdminJobModel->bulkAction();
    }

    /**
     * Function (for ajax) to process job delete request
     *
     * @param integer $job_id
     * @return void
     */
    public function delete($job_id)
    {
        $this->checkIfDemo();
        $this->AdminJobModel->remove(decode($job_id));
    }

    /**
     * Post Function to download jobs data in excel
     *
     * @return void
     */
    public function excel()
    {
        $data = $this->AdminJobModel->getJobsForCSV($this->xssCleanInput('ids'));
        $data = sortForCSV(objToArr($data));
        $excel = new SimpleExcel('csv');                    
        $excel->writer->setData($data);
        $excel->writer->saveFile('jobs'); 
        exit;
    }


    /**
     * Function (for ajax) to process add custom field request
     *
     * @return void
     */
    public function addCustomField()
    {
        $data['field'] = array('custom_field_id' => '', 'label' => '', 'value' => '');
        echo $this->load->view('admin/jobs/custom-field', $data, TRUE);
    }

    /**
     * Function (for ajax) to process remove custom field request
     *
     * @param integer $custom_field_id
     * @return void
     */
    public function removeCustomField($custom_field_id)
    {
        $this->checkIfDemo();
        $this->AdminJobModel->removeCustomField($custom_field_id);
    }

    /**
     * Function (via ajax) to view candidate job apply form
     *
     * @param $job_id integer
     * @return json
     */
    public function applyForCandidateView($job_id)
    {
        $data['candidates'] = objToArr($this->AdminCandidateModel->getAll());
        $data['traites'] = $this->AdminTraitModel->getJobTraits($job_id); 
        $data['job'] = objToArr($this->AdminJobModel->getJob('jobs.job_id', $job_id));
        $data['job_id'] = $job_id;
        echo $this->load->view('admin/jobs/apply-for-candidate', $data, TRUE);
        exit;
    }

    /**
     * Function (via ajax) to fetch candidate resumes
     *
     * @param $candidate_id integer
     * @return json
     */
    public function applyForCandidateResumesList($candidate_id)
    {
        $resumes = objToArr($this->ResumeModel->getCandidateResumesList($candidate_id));
        echo $this->load->view('admin/jobs/apply-for-candidate-resume-list', compact('resumes'), TRUE);
    }

    /**
     * Function (via ajax) to post candidate job apply form
     *
     * @return json
     */
    public function applyForCandidate()
    {
        $this->checkIfDemo();

        $applyResult = array('success' => '', 'message' => lang('some_error_occured'));
        $candidate_id = $this->xssCleanInput('candidate_id');
        
        if ($this->AdminJobModel->ifAlreadyApplied()) {
            die(json_encode(array(
                'success' => 'error',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('you_have_already_applied')))
            )));
        }

        $resume_id = $this->xssCleanInput('resume_id');
        if (!$resume_id) {
            die(json_encode(array(
                'success' => 'error',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('resume').' '.lang('required')))
            )));
        }

        if (setting('enable-multiple-resume') == 'yes') {

            $job = $this->AdminJobModel->getJob('jobs.job_id', $this->xssCleanInput('job_id'));
            $resume = $this->ResumeModel->getFirst('resumes.resume_id', $this->xssCleanInput('resume_id'));

            if ($job['is_static_allowed'] != 1 && $resume['type'] != 'detailed') {
                die(json_encode(array(
                    'success' => 'error',
                    'messages' => $this->ajaxErrorMessage(array('error' => lang('you_need_to_apply_via_detailed')))
                )));
            } else {
                $applyResult = $this->AdminJobModel->applyForCandidateByAdmin();
            }
        } else {
            $applyResult = $this->AdminJobModel->applyForCandidateByAdmin();
        }

        if ($applyResult['success'] == 'true') {
            die(json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('job_applied_successfully')))
            )));
        } else {
            die(json_encode(array(
                'success' => 'error',
                'messages' => $this->ajaxErrorMessage(array('error' => $applyResult['message']))
            )));
        }
    }

    /**
     * Function (via ajax) to view candidate job apply form
     *
     * @return json
     */
    public function importView()
    {
        $data = array();
        echo $this->load->view('admin/jobs/import', $data, TRUE);
        exit;
    }

    /**
     * Function (via ajax) to post candidate job apply form
     *
     * @return json
     */
    public function import()
    {
        $this->checkIfDemo();

        try {            
            //Uploading file
            $file = $this->uploadFile();
            
            //Reading uploaded file            
            $excel = new SimpleExcel('csv');
            $excel->parser->loadFile($file['file']);
            $sheetData = $excel->parser->getField();

            //Checking for valid column names
            $this->validColumnNames($sheetData[0]);
            
            //Removing first row
            unset($sheetData[0]);
            
            //Importing jobs
            $result = $this->AdminJobModel->importJobs($sheetData);
           
            if ($result) {
                die(json_encode(array(
                    'success' => 'true',
                    'messages' => $this->ajaxErrorMessage(array('success' => lang('jobs_imported_successfully')))
                )));
            } else {
                die(json_encode(array(
                    'success' => 'error',
                    'messages' => $this->ajaxErrorMessage(array('error' => lang('some_error_occured')))
                )));
            }
        } catch (\Throwable $e) {
            die(json_encode(array(
                'success' => 'error',
                'messages' => $this->ajaxErrorMessage(array('error' => $e->getMessage()))
            )));            
        }

    }

    public function uploadFile()
    {
        $ext = strtolower(pathinfo($_FILES['csv']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, array('csv'))) {
            die(json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => 'Only csv file allowed'))
            )));
        }

        //File and directory
        $dir = ASSET_ROOT.'/images/imports/';
        $file = $dir.'jobs.'.$ext;

        //Creating directory if not exists
        createDirectoryIfNotExists($file);

        //Uploading file
        move_uploaded_file($_FILES['csv']['tmp_name'], $file);
        return array('file' => $file, 'ext' => $ext);
    } 

    private function validColumnNames($columns)
    {
        $errors = '';
        if (issetVal($columns, 0) != 'department') {
            $errors .= '<li>First column should be "department"</li>';
        }
        if (issetVal($columns, 1) != 'title') {
            $errors .= '<li>Second column should be "title"</li>';
        }
        if (issetVal($columns, 2) != 'slug') {
            $errors .= '<li>Third column should be "slug"</li>';
        }
        if (issetVal($columns, 3) != 'description') {
            $errors .= '<li>Forth column should be "description"</li>';
        }
        if (issetVal($columns, 4) != 'meta_keywords') {
            $errors .= '<li>Fifth column should be "meta_keywords"</li>';
        }
        if (issetVal($columns, 5) != 'meta_description') {
            $errors .= '<li>Sixth column should be "meta_description"</li>';
        }
        if (issetVal($columns, 6) != 'min_salary') {
            $errors .= '<li>Seventh column should be "min_salary"</li>';
        }
        if (issetVal($columns, 7) != 'max_salary') {
            $errors .= '<li>Eighth column should be "max_salary"</li>';
        }
        if (issetVal($columns, 8) != 'number_of_positions') {
            $errors .= '<li>Ninth column should be "number_of_positions"</li>';
        }
        if (issetVal($columns, 9) != 'expiry_date') {
            $errors .= '<li>Tenth column should be "expiry_date"</li>';
        }
        if (issetVal($columns, 10) != 'published_at') {
            $errors .= '<li>Eleventh column should be "published_at"</li>';
        }
        if (issetVal($columns, 11) != 'status') {
            $errors .= '<li>Twelveth column should be "status"</li>';
        }
        if (issetVal($columns, 12) != 'is_static_allowed') {
            $errors .= '<li>Thirteenth column should be "is_static_allowed"</li>';
        }
        if ($errors) {
            $errors = '<ul>'.$errors.'</ul>';
            die(json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => $errors))
            )));
        }
    }

}
