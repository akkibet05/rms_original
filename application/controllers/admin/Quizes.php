<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

use SimpleExcel\SimpleExcel;
use Dompdf\Dompdf;

class Quizes extends CI_Controller
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
     * @param integer $quiz_id
     * @return html/string
     */
    public function createOrEdit($quiz_id = NULL)
    {
        $data['quiz'] = objToArr($this->AdminQuizModel->get('quiz_id', $quiz_id));
        $data['quiz_categories'] = $this->AdminQuizCategoryModel->getAll();
        echo $this->load->view('admin/quizes/create-or-edit', $data, TRUE);
    }

    /**
     * Function (for ajax) to process quiz create or edit form request
     *
     * @return redirect
     */
    public function save()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('title', lang('title'), 'required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('allowed_time', lang('allowed_time'), 'required|min_length[1]|max_length[4]|numeric');
        $this->form_validation->set_rules('description', lang('description'), 'required|min_length[10]|max_length[2500]');

        $edit = $this->xssCleanInput('quiz_id') ? $this->xssCleanInput('quiz_id') : false;

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } elseif ($this->AdminQuizModel->valueExist('title', $this->xssCleanInput('title'), $edit)) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('quiz_already_exist')))
            ));
        } else {
            $result = $this->AdminQuizModel->store($edit);
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('quiz').' ' . ($edit ? lang('updated') : lang('created')))),
                'data' => $result
            ));
        }
    }

    /**
     * Function (for ajax) to process quiz delete request
     *
     * @param integer $quiz_id
     * @return void
     */
    public function delete($quiz_id)
    {
        $this->checkIfDemo();
        $this->AdminQuizModel->remove($quiz_id);
    }

    /**
     * View Function (for ajax) to return quiz dropdown list
     *
     * @param integer $quiz_category_id
     * @return html/string
     */
    public function dropdown($quiz_category_id = NULL)
    {
        echo json_encode($this->AdminQuizModel->getDropDown($quiz_category_id));
    }

    /**
     * View Function (for ajax) to display clone form page via modal
     *
     * @param integer $quiz_id
     * @return html/string
     */
    public function cloneForm($quiz_id = NULL)
    {
        if ($quiz_id != '0') {
            $data['quiz'] = objToArr($this->AdminQuizModel->get('quiz_id', $quiz_id));
            $data['quiz_categories'] = $this->AdminQuizCategoryModel->getAll();
            echo $this->load->view('admin/quizes/clone', $data, TRUE);
        } else {
            echo $this->load->view('admin/quizes/no-quiz', array(), TRUE);
        }
    }

    /**
     * Function (for ajax) to process quiz clone form request
     *
     * @return redirect
     */
    public function cloneQuiz()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('title', lang('title'), 'required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('allowed_time', lang('allowed_time'), 'required|min_length[1]|max_length[4]|numeric');
        $this->form_validation->set_rules('description', lang('description'), 'required|min_length[10]|max_length[2500]');

        $edit = $this->xssCleanInput('quiz_id') ? $this->xssCleanInput('quiz_id') : false;

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } elseif ($this->AdminQuizModel->valueExist('title', $this->xssCleanInput('title'), $edit)) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => lang('quiz_already_exist')))
            ));
        } else {
            $result = $this->AdminQuizModel->cloneQuiz($edit);
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('quiz_cloned'))),
                'data' => $result
            ));
        }
    }

    /**
     * Post Function to download quiz
     *
     * @param integer $quiz_id
     * @return void
     */
    public function download($quiz_id = NULL)
    {
        $result = $this->AdminQuizModel->getCompleteQuiz($quiz_id);
        $quiz = $this->load->view('admin/quizes/quiz-pdf', $result, TRUE);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($quiz);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('quiz.pdf');
        exit;
    }
}
