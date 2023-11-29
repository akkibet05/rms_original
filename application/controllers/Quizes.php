<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

class Quizes extends CI_Controller
{
    /**
     * View Function to display candidate quiz listing page
     *
     * @param integer $page
     * @return html/string
     */
    public function listView($page = null)
    {
        $this->checkLogin();
        $total = $this->QuizModel->getTotalCandidateQuizes();
        $limit = 5;
        $pageData['page'] = lang('assigned_quizes').' | ' . setting('site-name');
        $data['page'] = 'quizes';
        $data['quizes'] = $this->QuizModel->getCandidateQuizes($limit, $page);
        $data['pagination'] = $this->createPagination($page, '/account/quizes/', $total, $limit);
        $data['breadcrumb_title'] = lang('assigned_quizes');
        $data['breadcrumb_page'] = 'account/quizes';
        $this->load->view('front/'.viewPrfx().'/layout/header', $pageData);
        $this->load->view('front/'.viewPrfx().'/account-quiz-listing', $data);
    }

    /**
     * View Function to display quiz detail and attempt page
     *
     * @param  $id string
     * @return html/string
     */
    public function attemptView($id = null)
    {        
        $this->checkLogin();
        $pageData['page'] = lang('attempt_quiz').' | ' . setting('site-name');

        $detail = $this->QuizModel->getQuiz($id);
        if (!$detail) {
            redirect('404_override');
        }

        $quiz = objToArr(json_decode($detail['quiz_data']));
        $started_at = $detail['started_at'] ? $detail['started_at'] : date('Y-m-d G:i:s');
        $data['page'] = 'quizes';
        $data['detail'] = $detail;
        $data['quiz'] = $quiz['quiz'];
        $data['questions'] = $quiz['questions'];
        $data['time'] = quizTime($started_at, $detail['allowed_time']);
        $data['breadcrumb_title'] = lang('attempt_quiz');
        $data['breadcrumb_page'] = 'account/quiz/'.$id;

        if ($detail['attempt'] > 0) {
            if ($data['time']['diff'] > 0 && ($detail['attempt'] <= $detail['total_questions'])) {
                $data['question'] = $data['questions'][$detail['attempt']-1];
                $this->load->view('front/'.viewPrfx().'/layout/header', $pageData);
                $this->load->view('front/'.viewPrfx().'/account-quiz-attempt', $data);
            } else {
                $this->load->view('front/'.viewPrfx().'/layout/header', $pageData);
                $this->load->view('front/'.viewPrfx().'/account-quiz-done', $data);
            }
        } else {
            $this->load->view('front/'.viewPrfx().'/layout/header', $pageData);
            $this->load->view('front/'.viewPrfx().'/account-quiz-detail', $data);
        }
    }

    /**
     * Function (form post) to record quiz progress
     *
     * @return html/string
     */
    public function attempt()
    {
        $this->checkIfDemo('reload');
        $this->QuizModel->updateCandidateQuiz();
        redirect('account/quiz/'.$this->xssCleanInput('quiz'));
    }
}

