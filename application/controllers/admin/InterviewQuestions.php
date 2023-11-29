<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InterviewQuestions extends CI_Controller
{
    /**
     * Function to get data for questions list
     *
     * @param integer $interview_id
     * @return json
     */
    public function index($interview_id = '')
    {
        $questions = $this->AdminInterviewQuestionModel->getAll($interview_id);
        echo $this->load->view('admin/interview-questions/list-items', compact('questions'), TRUE);
    }

    /**
     * Function to add question to interview from data bank by drag and drop
     *
     * @param integer $interview_id
     * @param integer $question_id
     * @return json
     */
    public function add($interview_id = '', $question_id = '')
    {
        $question = objToArr($this->AdminQuestionModel->getQuestion('question_id', $question_id));
        $answers = objToArr($this->AdminQuestionAnswerModel->getQuestionAnswers('question_id', $question_id));
        echo $this->AdminInterviewQuestionModel->add($interview_id, $question, $answers);
    }

    /**
     * View Function (for ajax) to display create or edit view page via modal
     *
     * @param integer $interview_question_id
     * @return html/string
     */
    public function edit($interview_question_id = NULL)
    {
        $data['question'] = objToArr($this->AdminInterviewQuestionModel->get('interview_question_id', $interview_question_id));
        echo $this->load->view('admin/interview-questions/edit', $data, TRUE);
    }

    /**
     * Function (for ajax) to process question create or edit form request
     *
     * @return redirect
     */
    public function save()
    {
        $this->checkIfDemo();
        $this->form_validation->set_rules('title', lang('title'), 'required|min_length[10]|max_length[1000]');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array(
                'success' => 'false',
                'messages' => $this->ajaxErrorMessage(array('error' => validation_errors()))
            ));
        } else {
            $this->AdminInterviewQuestionModel->update();
            echo json_encode(array(
                'success' => 'true',
                'messages' => $this->ajaxErrorMessage(array('success' => lang('question_updated')))
            ));
        }
    }    

    /**
     * Post Function (via ajax) to order questions in interview
     *
     * @return void
     */
    public function order()
    {
        $this->checkIfDemo();
        $this->AdminInterviewQuestionModel->orderQuestions();
    }

    /**
     * Post Function (via ajax) to delete question in interview
     *
     * @return void
     */
    public function delete($interview_question_id = '')
    {
        $this->checkIfDemo();
        $this->AdminInterviewQuestionModel->delete($interview_question_id);
    }

    /**
     * Function (for ajax) to process add new answer request to a opened question
     *
     * @param integer $interview_question_id
     * @param string $type
     * @return html/string
     */
    public function addAnswer($interview_question_id = '', $type = null)
    {
        $data['interview_question_id'] = $interview_question_id;
        $data['type'] = $type;
        echo $this->load->view('admin/interview-questions/new-answer-item', $data, TRUE);
    }

    /**
     * Function (for ajax) to process remove answer request to a opened question
     *
     * @param integer $question_answer_id
     * @return void
     */
    public function removeAnswer($question_answer_id = '', $type = null)
    {
        $this->checkIfDemo();
        $this->AdminInterviewQuestionModel->removeAnswer($question_answer_id);
    }

}
