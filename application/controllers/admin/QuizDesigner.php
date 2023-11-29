<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QuizDesigner extends CI_Controller
{
    /**
     * View Function For the overall page of quiz designer
     *
     * @return html/string
     */
    public function index($nature = 'quiz')
    {
        $this->checkAdminLogin();
        $header['page'] = lang('quizes');
        $header['menu'] = 'quizes';

        $questionsResults = $this->AdminQuestionModel->getAll();
        $questions = $questionsResults['records'];
        $data['questions_page'] = $this->sess($nature.'_questions_page', 1);
        $data['questions_per_page'] = $this->sess($nature.'_questions_per_page');
        $data['questions_search'] = $this->sess($nature.'_questions_search');
        $data['questions_category_id'] = $this->sess($nature.'_questions_category_id');
        $data['questions_type'] = $this->sess($nature.'_questions_type');
        $data['total_pages'] = $questionsResults['total_pages'];
        $data['pagination'] = $questionsResults['pagination'];
        $data['questions'] = $this->load->view('admin/questions/list-items', compact('questions', 'nature'), TRUE);
        $data['question_categories'] = $this->AdminQuestionCategoryModel->getAll();
        $data['quiz_categories'] = $this->AdminQuizCategoryModel->getAll();
        $this->load->view('admin/layout/header', $header);
        $this->load->view('admin/quizes/designer', $data);
    }
}
