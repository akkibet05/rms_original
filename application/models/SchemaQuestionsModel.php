<?php

class SchemaQuestionsModel extends CI_Model
{
    public function __construct()
    {
        $this->load->dbforge();
    }

    public function run()
    {
        $this->createQuestionCategoriesTable();
        $this->createQuestionsTable();
        $this->createQuestionAnswersTable();
        $this->createQuizCategoriesTable();
        $this->createQuizesTable();
        $this->createQuizQuestionsTable();
        $this->createQuizQuestionAnswersTable();
        $this->createJobQuizesTable();
        $this->createCandidateQuizesTable();

        $this->createInterviewCategoriesTable();
        $this->createInterviewsTable();
        $this->createInterviewQuestionsTable();
        $this->createCandidateInterviewsTable();
        $this->addColumnsToCandidateInterviews();
    }

    private function createQuestionCategoriesTable()
    {
        $fields = array(
            'question_category_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'status' => array('type' => 'TINYINT', 'default' => '1',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('question_categories', $fields, 'question_category_id');
    }

    private function createQuestionsTable()
    {
        $fields = array(
            'question_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'question_category_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'TEXT',),
            'image' => array('type' => 'VARCHAR', 'constraint' => '250',),
            'type' => array('type' => 'VARCHAR', 'constraint' => '20',),
            'nature' => array('type' => 'VARCHAR', 'constraint' => '20', 'default' => 'quiz',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('questions', $fields, 'question_id');
    }

    private function createQuestionAnswersTable()
    {
        $fields = array(
            'question_answer_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'question_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'is_correct' => array('type' => 'TINYINT',),
        );
        $this->createTable('question_answers', $fields, 'question_answer_id');
    }

    private function createQuizCategoriesTable()
    {
        $fields = array(
            'quiz_category_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'status' => array('type' => 'TINYINT', 'default' => '1',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('quiz_categories', $fields, 'quiz_category_id');
    }

    private function createQuizesTable()
    {
        $fields = array(
            'quiz_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'quiz_category_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'description' => array('type' => 'TEXT', 'null' => TRUE,),
            'allowed_time' => array('type' => 'INT', 'constraint' => '5',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('quizes', $fields, 'quiz_id');
    }

    private function createQuizQuestionsTable()
    {
        $fields = array(
            'quiz_question_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'quiz_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'TEXT'),
            'image' => array('type' => 'VARCHAR', 'constraint' => '250',),
            'type' => array('type' => 'VARCHAR', 'constraint' => '20',),
            'order' => array('type' => 'TINYINT',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('quiz_questions', $fields, 'quiz_question_id');
    }

    private function createQuizQuestionAnswersTable()
    {
        $fields = array(
            'quiz_question_answer_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'quiz_question_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'is_correct' => array('type' => 'TINYINT',),
        );
        $this->createTable('quiz_question_answers', $fields, 'quiz_question_answer_id');
    }

    private function createJobQuizesTable()
    {
        $fields = array(
            'job_quiz_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'job_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'quiz_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'quiz_title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'total_questions' => array('type' => 'TINYINT', 'null' => TRUE,),
            'allowed_time' => array('type' => 'TINYINT', 'null' => TRUE,),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'quiz_data' => array('type' => 'TEXT', 'null' => TRUE,),
        );
        $this->createTable('job_quizes', $fields, 'job_quiz_id');
    }

    private function createCandidateQuizesTable()
    {
        $fields = array(
            'candidate_quiz_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'candidate_id' => array('type' => 'INT'),
            'job_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'job_quiz_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'quiz_title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'quiz_data' => array('type' => 'TEXT', 'null' => TRUE,),
            'answers_data' => array('type' => 'TEXT', 'null' => TRUE,),
            'total_questions' => array('type' => 'TINYINT', 'null' => TRUE,),
            'allowed_time' => array('type' => 'TINYINT', 'null' => TRUE,),
            'correct_answers' => array('type' => 'TINYINT', 'null' => TRUE,),
            'attempt' => array('type' => 'TINYINT', 'null' => TRUE,),
            'started_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('candidate_quizes', $fields, 'candidate_quiz_id');
    }

    private function createInterviewCategoriesTable()
    {
        $fields = array(
            'interview_category_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'status' => array('type' => 'TINYINT', 'default' => '1',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('interview_categories', $fields, 'interview_category_id');
    }

    private function createInterviewsTable()
    {
        $fields = array(
            'interview_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'interview_category_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '100',),
            'description' => array('type' => 'TEXT', 'null' => TRUE,),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('interviews', $fields, 'interview_id');
    }

    private function createInterviewQuestionsTable()
    {
        $fields = array(
            'interview_question_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'interview_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'account_id' => array('type' => 'INT', 'unsigned' => TRUE, 'null' => TRUE,),
            'title' => array('type' => 'TEXT'),
            'image' => array('type' => 'VARCHAR', 'constraint' => '250',),
            'order' => array('type' => 'TINYINT',),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('interview_questions', $fields, 'interview_question_id');
    }

    private function createCandidateInterviewsTable()
    {
        $fields = array(
            'candidate_interview_id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE,),
            'candidate_id' => array('type' => 'INT'),
            'job_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'user_id' => array('type' => 'INT', 'unsigned' => TRUE,),
            'interview_title' => array('type' => 'VARCHAR', 'constraint' => '250',),
            'interview_data' => array('type' => 'TEXT', 'null' => TRUE,),
            'answers_data' => array('type' => 'TEXT', 'null' => TRUE,),
            'total_questions' => array('type' => 'INT', 'null' => TRUE,),
            'overall_rating' => array('type' => 'INT', 'null' => TRUE,),
            'status' => array('type' => 'TINYINT', 'default' => '0',),
            'interview_time' => array('type' => 'DATETIME', 'null' => TRUE,),
            'updated_at' => array('type' => 'DATETIME', 'null' => TRUE,),
            'created_at' => array('type' => 'DATETIME', 'null' => TRUE,),
        );
        $this->createTable('candidate_interviews', $fields, 'candidate_interview_id');
    }

    //Added in version 1.2
    private function addColumnsToCandidateInterviews()
    {
        $tbl = 'candidate_interviews';
        $fields = array(
            'description' => array('type' => 'TEXT', 'after' => 'interview_time', 'null' => TRUE,),
        );
        if (!$this->db->field_exists('description', $tbl) && $this->db->table_exists($tbl)) {
            $this->dbforge->add_column($tbl, $fields);
        }
    }

    private function createTable($table, $fields, $key = null)
    {
        $this->dbforge->add_field($fields);
        if ($key) {
            $this->dbforge->add_key($key, TRUE);
        }
        $this->dbforge->create_table($table, TRUE);
    }
}