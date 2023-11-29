<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

use SimpleExcel\SimpleExcel;
use Dompdf\Dompdf;

class JobBoard extends CI_Controller
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
     * View Function For the overall page of job board
     *
     * @return html/string
     */
    public function index($job_id = '')
    {
        $header['page'] = lang('job_board');
        $header['menu'] = 'job_board';

        $jobsResults = $this->AdminJobBoardModel->getJobs();
        $jobs = $jobsResults['records'];
        $data['jobs_total_pages'] = $jobsResults['total_pages'];
        $data['jobs_pagination'] = $jobsResults['pagination'];
        $data['jobs'] = $this->load->view('admin/job-board/job-list-items', compact('jobs'), TRUE);

        //Getting session values for search, filters and pagination for jobs and candidates
        $session_data = array('jobs_per_page','jobs_search','jobs_company_id','jobs_department_id',
                            'jobs_status','candidates_per_page','candidates_search','candidates_sort',
                            'candidates_min_age','candidates_max_age', 'candidates_gender',
                            'candidates_min_experience','candidates_max_experience','candidates_min_overall',
                            'candidates_max_overall','candidates_min_interview','candidates_max_interview',
                            'candidates_min_quiz','candidates_max_quiz','candidates_min_self','candidates_max_self',
                            'candidates_city','candidates_state','candidates_country','candidates_address',);
        foreach ($session_data as $value) {
            $data[$value] = $this->session->userdata($value);
        }
        $data['jobs_page'] = $this->sess('jobs_page', 1);
        $data['candidates_page'] = $this->sess('candidates_page', 1);

        $data['companies'] = objToArr($this->AdminCompanyModel->getAll());
        $data['departments'] = objToArr($this->AdminDepartmentModel->getAll());
        $data['first_job_id'] = $job_id ? $job_id : (isset($jobs[0]['job_id']) ? $jobs[0]['job_id'] : '');

        $this->load->view('admin/layout/header', $header);
        $this->load->view('admin/job-board/index', $data);
    }

    /**
     * Function (via ajax) to get data for jobs list
     *
     * @return json
     */
    public function jobsList()
    {
        $jobsResults = $this->AdminJobBoardModel->getJobs();
        $jobs = $jobsResults['records'];
        echo json_encode(array(
            'pagination' => $jobsResults['pagination'],
            'total_pages' => $jobsResults['total_pages'],
            'list' => $this->load->view('admin/job-board/job-list-items', compact('jobs'), TRUE),
        ));
    }

    /**
     * Function (via ajax) to get data for candidates list
     *
     * @param $job_id integer
     * @return json
     */
    public function candidatesList($job_id = '')
    {
        $candidatesResults = $this->AdminJobBoardModel->getCandidates($job_id);
        $candidates = $candidatesResults['records'];
        echo json_encode(array(
            'pagination' => $candidatesResults['pagination'],
            'total_pages' => $candidatesResults['total_pages'],
            'candidates_all' => $candidatesResults['candidates_all'],
            'list' => $this->load->view('admin/job-board/candidate-list-items', compact('candidates'), TRUE),
        ));
    }

    /**
     * Function (via ajax) to view assign quiz or interview to candidate(s)
     *
     * @param $type string
     * @param $job_id integer
     * @return json
     */
    public function assignView($type = '', $job_id = '')
    {
        if ($type == 'quiz') {
            $data['quizes'] = $this->AdminQuizModel->getAll();
        } else {
            $data['interviews'] = $this->AdminInterviewModel->getAll();
            $data['users'] = objToArr($this->AdminUserModel->getAll());
        }
        $data['type'] = $type;
        $data['job_id'] = $job_id;
        echo $this->load->view('admin/job-board/assign', $data, TRUE);
        exit;
    }

    /**
     * Function (via ajax) to assign quiz or interview to candidate(s)
     *
     * @return json
     */
    public function assign()
    {
        ini_set('max_execution_time', 5000);
        $this->checkIfDemo();
        $this->AdminJobBoardModel->assignToCandidates();

        $data = $this->xssCleanInput();
        $candidates = json_decode($data['candidates']);

        if (isset($data['notify_candidate'])) {
            foreach ($candidates as $candidate_id) {
                $candidate = objToArr($this->AdminCandidateModel->getCandidate('candidate_id', $candidate_id));
                if ($data['type'] == 'interview') {
                    $interview_time = $data['interview_time'];
                    $description = $data['description'];
                    $subject = lang('interview_schedule');
                    $message = $this->load->view(
                        'admin/emails/candidate-interview-notification', compact('candidate', 'interview_time', 'description'), TRUE
                    );
                } else {
                    $subject = lang('quiz_assigned');
                    $message = $this->load->view('admin/emails/candidate-quiz-notification', compact('candidate'), TRUE);
                }
                $this->sendEmail($message, $candidate['email'], $subject);
            }
        }

        if (isset($data['notify_team_member'])) {
            $user = objToArr($this->AdminUserModel->getUser('user_id', $data['user_id']));
            $interview_time = $data['interview_time'];
            $description = $data['description'];
            $message = $this->load->view(
                'admin/emails/team-member-interview-notification', compact('user', 'interview_time', 'description'), TRUE
            );
            $this->sendEmail(
                $message,
                $user['email'],
                'Interview Schedule'
            );
        }

        echo json_encode(array(
            'success' => 'true',
            'messages' => lang('assigned')
        ));
    }


    /**
     * Function (via ajax) to view edit overall result
     *
     * @param $job_app_id integer
     * @return json
     */
    public function editOverallResult($job_app_id = '')
    {
        $data['job_app_id'] = $job_app_id;
        echo $this->load->view('admin/job-board/edit-overall-result', $data, TRUE);
        exit;
    }

    /**
     * Function (via ajax) to update candidate overall result
     *
     * @return json
     */
    public function saveOverallResult()
    {
        $this->form_validation->set_rules('overall_result', lang('overall_result'), 'trim|required|min_length[1]|max_length[3]|numeric');

        if ($this->form_validation->run() === FALSE) {
            die(json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            )));
        }

        $this->AdminJobBoardModel->updateOverallResult();
        echo json_encode(array(
            'success' => 'true',
            'messages' => lang('updated')
        ));
    }

    /**
     * Function (via ajax) to update candidate job application status
     *
     * @return json
     */
    public function candidateStatus()
    {
        $this->AdminJobBoardModel->updateCandidateStatus();
        echo json_encode(array(
            'success' => 'true',
            'messages' => lang('assigned')
        ));
    }

    /**
     * Function (via ajax) to delete candidate job application
     *
     * @return json
     */
    public function deleteApplication()
    {
        $this->AdminJobBoardModel->deleteCandidateApplication();
        echo json_encode(array(
            'success' => 'true',
            'messages' => lang('delete')
        ));
    }

    /**
     * Function (via ajax) to view job detail
     *
     * @param  $job_id integer
     * @return json
     */
    public function viewJob($job_id = '')
    {
        $job = objToArr($this->AdminJobModel->getJob('jobs.job_id', $job_id));
        echo $this->load->view('admin/job-board/job-detail', compact('job'), TRUE);
    }

    /**
     * Function (via ajax) to view resume
     *
     * @param  $resume_id integer
     * @return json
     */
    public function viewResume($resume_id = '')
    {
        $resume = objToArr($this->AdminCandidateModel->getCompleteResume($resume_id, true));
        $resume_file = issetVal($resume, 'file');
        $resume_id = issetVal($resume, 'resume_id');
        $data['resume_id'] = $resume_id;
        $data['type'] = issetVal($resume, 'type');
        $data['file'] = issetVal($resume, 'file');
        $data['resume'] = $this->load->view('admin/candidates/resume', compact('resume', 'resume_file', 'resume_id'), TRUE);
        echo $this->load->view('admin/job-board/resume', $data, TRUE);
    }

    /**
     * Function do export overall result in excel
     *
     * @return json
     */
    public function overallResult()
    {
        ini_set('max_execution_time', '0');
        $result = $this->AdminJobBoardModel->overallResult();
        $data = sortForCSV($result);
        $excel = new SimpleExcel('csv');
        $excel->writer->setData($data);
        $excel->writer->saveFile('overallResult');
        exit;
    }

    /**
     * Function do export pdf result for traits, quizes and interviews
     *
     * @return json
     */
    public function pdfResult()
    {
        $this->checkIfDemo('reload');
        ini_set('max_execution_time', '0');
        $results = '';
        $filename = '';

        if ($this->xssCleanInput('type') == 'e-self') {
            $result = $this->AdminJobBoardModel->traitsResult();
            foreach ($result as $r) {
                $data['trait'] = $r;
                $results .= $this->load->view('admin/job-board/pdf-traits', $data, TRUE);
            }
            $filename = $this->xssCleanInput('job').'-SelfAssementResults.pdf';
        } else if ($this->xssCleanInput('type') == 'e-quiz') {
            $result = $this->AdminJobBoardModel->quizesResult();
            foreach ($result as $r) {
                $data['quizes'] = $r;
                $results .= $this->load->view('admin/job-board/pdf-quizes', $data, TRUE);
            }
            $filename = $this->xssCleanInput('job').'-QuizResults.pdf';
        } else if ($this->xssCleanInput('type') == 'e-interview') {
            $result = $this->AdminJobBoardModel->interviewsResult();
            foreach ($result as $r) {
                $data['interviews'] = $r;
                $results .= $this->load->view('admin/job-board/pdf-interviews', $data, TRUE);
            }
            $filename = $this->xssCleanInput('job').'-interviewsResults.pdf';
        }

        $dompdf = new Dompdf();
        $dompdf->loadHtml($results);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream($filename);
        exit;
    }

    /**
     * Function (for ajax) to delete candidate interview
     *
     * @param  $candidate_interview_id integer
     * @return redirect
     */
    public function deleteInterview($candidate_interview_id = '')
    {
        $this->checkIfDemo();
        $data = $this->AdminCandidateInterviewModel->deleteCandidateInterview($candidate_interview_id);
        $this->AdminJobBoardModel->updateInterviewResultInJobApplication($data);
        $this->AdminJobBoardModel->updateOverallResultInJobApplication($data);
        echo json_encode(array(
            'success' => 'true',
            'messages' => $this->ajaxErrorMessage(array('success' => lang('candidate_interview_deleted')))
        ));
    }

    /**
     * Function (for ajax) to delete candidate quiz
     *
     * @param  $candidate_quiz_id integer
     * @return redirect
     */
    public function deleteQuiz($candidate_quiz_id = '')
    {
        $this->checkIfDemo();
        $data = $this->AdminQuizModel->deleteCandidateQuiz($candidate_quiz_id);
        $this->AdminJobBoardModel->updateQuizResultInJobApplication($data);
        $this->AdminJobBoardModel->updateOverallResultInJobApplication($data);
        echo json_encode(array(
            'success' => 'true',
            'messages' => $this->ajaxErrorMessage(array('success' => lang('candidate_quiz_deleted')))
        ));
    }

}
