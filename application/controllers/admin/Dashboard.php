<?php

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkAdminLogin();
    }

    /**
     * Function to load dashboard main page
     *
     * @return json
     */
    public function index()
    {
        $data['page'] = lang('dashboard');
        $data['menu'] = 'dashboard';
        $data['jobs'] = $this->AdminJobModel->getAll();
        $data['jobsCount'] = $this->AdminJobModel->getTotalJobs();
        $data['candidates'] = $this->AdminCandidateModel->getTotalCandidates();
        $data['applications'] = $this->AdminJobBoardModel->getJobApplicationsCount();
        $data['hired'] = $this->AdminJobBoardModel->getJobApplicationsCount('hired');
        $data['rejected'] = $this->AdminJobBoardModel->getJobApplicationsCount('rejected');
        $data['interviews'] = $this->AdminInterviewModel->getInterviewsCount();
        $data['dashboard_jobs_page'] = $this->sess('dashboard_jobs_page', 1);
        $data['dashboard_jobs_total_pages'] = $this->sess('dashboard_jobs_total_pages');
        $data['dashboard_todos_page'] = $this->sess('dashboard_todos_page', 1);
        $data['dashboard_todos_total_pages'] = $this->sess('dashboard_todos_total_pages');
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/dashboard/index');
    }

    /**
     * Function (via ajax) to get data for popular job charts
     *
     * @return json
     */
    public function popularJobsChartData()
    {
        echo $this->AdminJobModel->getPopularJobs();
    }

    /**
     * Function (via ajax) to get data for candidates cahrts
     *
     * @return json
     */
    public function topCandidatesChartData()
    {
        echo $this->AdminCandidateModel->getTopCandidates();
    }

    /**
     * Function (via ajax) to get data for job statuses
     *
     * @return json
     */
    public function jobsList()
    {
        $jobsResults = $this->AdminDashboardModel->getJobs();
        $jobs = $jobsResults['records'];
        echo json_encode(array(
            'pagination' => $jobsResults['pagination'],
            'total_pages' => $jobsResults['total_pages'],
            'list' => $this->load->view('admin/dashboard/job-item', compact('jobs'), TRUE),
        ));
    }

}
