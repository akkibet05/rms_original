<?php

class DataQuestionsModel extends CI_Model
{
    public function __construct()
    {
        $this->load->dbforge();
    }

    public function run()
    {
        ini_set('max_execution_time', '1000');
        $this->importQuestionCategories();
        $this->importQuestions();
        $this->importQuestions2();
        $this->importQuizCategories();
        $this->importQuizes();
        $this->importQuizQuestions();
        $this->importInterviewCategories();
        $this->importInterviews();
        $this->importInterviewQuestions();
    }

    public function importQuestionCategories()
    {
        $data = array(
            array(
                'title' => 'Computers & IT',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Marketing',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'General Knowledge',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'General',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
        );
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('question_categories');
            if ($result->num_rows() <= 0) {
                $this->db->insert('question_categories', $d);
            }
        }
    }

    public function importQuestions()
    {
        $data = array(
            array(
                'question_category_id' => 1,
                'title' => 'A computer basically constitutes of _______ integral components',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Two', 'is_correct' => '0'),
                    array('title' => 'Four', 'is_correct' => '0'),
                    array('title' => 'Three', 'is_correct' => '1'),
                    array('title' => 'Eight', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 1,
                'title' => 'Computers have secondary storage devices known as',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'ALU', 'is_correct' => '0'),
                    array('title' => 'Auxiliary Storage', 'is_correct' => '1'),
                    array('title' => 'CPU', 'is_correct' => '0'),
                    array('title' => 'None of the above', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 1,
                'title' => 'Computers have secondary storage devices known as',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'ALU', 'is_correct' => '0'),
                    array('title' => 'Auxiliary Storage', 'is_correct' => '1'),
                    array('title' => 'CPU', 'is_correct' => '0'),
                    array('title' => 'None of the above', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 1,
                'title' => 'The ____ is responsible for various computer operations',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Memory', 'is_correct' => '0'),
                    array('title' => 'Accumulator (ACU)', 'is_correct' => '0'),
                    array('title' => 'Control Unit', 'is_correct' => '1'),
                    array('title' => 'Memory Address Register (MAR)', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 1,
                'title' => 'Popular microprocessors include',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Intel', 'is_correct' => '1'),
                    array('title' => 'Cache Memory', 'is_correct' => '0'),
                    array('title' => 'AMD', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 1,
                'title' => 'These types of computers are primarily involved in data processing and problem solving for specific programs.',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Compact computers', 'is_correct' => '0'),
                    array('title' => 'Digital computers', 'is_correct' => '1'),
                    array('title' => 'Hybrid computers', 'is_correct' => '0'),
                    array('title' => 'Analog computers', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 1,
                'title' => 'It mediates communication between CPU and other components of system.',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'CPU', 'is_correct' => '0'),
                    array('title' => 'RAM', 'is_correct' => '0'),
                    array('title' => 'Chipset', 'is_correct' => '1'),
                    array('title' => 'Buses', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 1,
                'title' => 'Software that resides on a single computer and does not interact with any other software installed in a different computer.',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Stand Alone Software', 'is_correct' => '1'),
                    array('title' => 'Embedded Software', 'is_correct' => '0'),
                    array('title' => 'Real Time Software', 'is_correct' => '0'),
                    array('title' => 'Network Software', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 1,
                'title' => '____ was the first high level language developed by John Backus at IBM in 1956.',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'FORTRAN', 'is_correct' => '1'),
                    array('title' => 'COBOL', 'is_correct' => '0'),
                    array('title' => 'Basic', 'is_correct' => '0'),
                    array('title' => 'None of the above', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 1,
                'title' => '____ was the first high level language developed by John Backus at IBM in 1956.',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'FORTRAN', 'is_correct' => '1'),
                    array('title' => 'COBOL', 'is_correct' => '0'),
                    array('title' => 'Basic', 'is_correct' => '0'),
                    array('title' => 'None of the above', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 1,
                'title' => '____ is a presentation tool that helps create eye catching and effective presentations in a matter of minutes',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Spreadsheet', 'is_correct' => '0'),
                    array('title' => 'Word Processing', 'is_correct' => '0'),
                    array('title' => 'Bits', 'is_correct' => '0'),
                    array('title' => 'Power Point', 'is_correct' => '1'),
                ),
            ),
            array(
                'question_category_id' => 1,
                'title' => 'The professionals involved in the study and prediction of weather are called.',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Seer', 'is_correct' => '0'),
                    array('title' => 'Doom Sayer', 'is_correct' => '0'),
                    array('title' => 'Meteorologists', 'is_correct' => '1'),
                    array('title' => 'None of the above', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 1,
                'title' => 'The various types of computers are.',
                'type' => 'checkbox',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Personal Computers', 'is_correct' => '1'),
                    array('title' => 'Workstations', 'is_correct' => '1'),
                    array('title' => 'Tablet PC', 'is_correct' => '1'),
                    array('title' => 'Car Dashboard', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 1,
                'title' => 'It is very important for a computer system to have the ability to communicate with the outside world.',
                'type' => 'checkbox',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Receive data', 'is_correct' => '1'),
                    array('title' => 'Send Data', 'is_correct' => '1'),
                    array('title' => 'All of the above', 'is_correct' => '1'),
                ),
            ),
            array(
                'question_category_id' => 1,
                'title' => '1 Gigabyte is equal to',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => '1024 bits', 'is_correct' => '0'),
                    array('title' => '1024 bytes', 'is_correct' => '0'),
                    array('title' => '1024 megabytes', 'is_correct' => '1'),
                    array('title' => '1024 kilobytes', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 1,
                'title' => 'Pen drive is a',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Primary Memory', 'is_correct' => '0'),
                    array('title' => 'Secondary Memory', 'is_correct' => '1'),
                    array('title' => 'Cache Memory', 'is_correct' => '0'),
                    array('title' => 'Internal Memory', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 1,
                'title' => 'How many types of constructors are available, in general, in any language?',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => '2', 'is_correct' => '0'),
                    array('title' => '3', 'is_correct' => '1'),
                    array('title' => '4', 'is_correct' => '0'),
                    array('title' => '5', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 1,
                'title' => 'Which among the following is true for static constructor?',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Static constructors are called with every new object', 'is_correct' => '0'),
                    array('title' => 'Static constructors are used initialize data members to zero always', 'is_correct' => '0'),
                    array('title' => 'Static constructors can’t be parameterized constructors', 'is_correct' => '1'),
                    array('title' => 'Static constructors can be used to initialize the non-static members also', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 1,
                'title' => 'Within a class, only one static constructor can be created.',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'True', 'is_correct' => '1'),
                    array('title' => 'False', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 1,
                'title' => 'Why do we use constructor overloading?',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'To use different types of constructors', 'is_correct' => '0'),
                    array('title' => 'Because it’s a feature provided', 'is_correct' => '0'),
                    array('title' => 'To initialize the object in different ways', 'is_correct' => '1'),
                    array('title' => 'To differentiate one constructor from another', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 1,
                'title' => 'The destructor can be called before the constructor if required.',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'True', 'is_correct' => '0'),
                    array('title' => 'False', 'is_correct' => '1'),
                ),
            ),
            array(
                'question_category_id' => 1,
                'title' => ' If in multiple inheritance, class C inherits class B, and Class B inherits class A. In which sequence are their destructors called if an object of class C was declared?',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => '~C() then ~B() then ~A()', 'is_correct' => '1'),
                    array('title' => '~B() then ~C() then ~A()', 'is_correct' => '0'),
                    array('title' => '~A() then ~B() then ~C()', 'is_correct' => '0'),
                    array('title' => '~C() then ~A() then ~B()', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 2,
                'title' => 'Good marketing is no accident, but a result of careful planning and ________',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'execution', 'is_correct' => '1'),
                    array('title' => 'selling', 'is_correct' => '0'),
                    array('title' => 'strategies', 'is_correct' => '0'),
                    array('title' => 'tactics', 'is_correct' => '0'),
                    array('title' => 'research', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 2,
                'title' => 'The most formal definition of marketing is ________',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'meeting needs profitably', 'is_correct' => '0'),
                    array('title' => 'identifying and meeting human and social needs', 'is_correct' => '0'),
                    array('title' => 'the 4Ps (Product, Price, Place, Promotion)', 'is_correct' => '0'),
                    array('title' => 'an organizational function and a set of processes for creating, communicating,and delivering, value to customers, and for managing customer relationships inways that benefit the organization and its stake holders', 'is_correct' => '1'),
                    array('title' => 'improving the quality of life for consumers', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 2,
                'title' => '________ can be produced and marketed as a product.',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Information', 'is_correct' => '1'),
                    array('title' => 'Celebrities', 'is_correct' => '0'),
                    array('title' => 'Durable goods', 'is_correct' => '0'),
                    array('title' => 'Organizations', 'is_correct' => '0'),
                    array('title' => 'Properties', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 2,
                'title' => 'The   ________   promises   to   lead   to   more   accurate   levels   of   production,   moretargeted communications, and more relevant pricing.',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Age of Globalization', 'is_correct' => '0'),
                    array('title' => 'Age of Deregulation', 'is_correct' => '0'),
                    array('title' => 'Industrial Age', 'is_correct' => '0'),
                    array('title' => 'Information Ag', 'is_correct' => '1'),
                    array('title' => 'Production Age', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 2,
                'title' => 'Marketers often use the term ________ to cover various groupings of customers.',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'people', 'is_correct' => '0'),
                    array('title' => 'buying power', 'is_correct' => '0'),
                    array('title' => 'demographic segment', 'is_correct' => '0'),
                    array('title' => 'social class position', 'is_correct' => '0'),
                    array('title' => 'market', 'is_correct' => '1'),
                ),
            ),
            array(
                'question_category_id' => 2,
                'title' => 'Customers are showing greater price sensitivity in their search for ________',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'The right product', 'is_correct' => '0'),
                    array('title' => 'The right service', 'is_correct' => '0'),
                    array('title' => 'The right store', 'is_correct' => '0'),
                    array('title' => 'Value', 'is_correct' => '1'),
                    array('title' => 'Relationships', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 2,
                'title' => 'The ________ concept holds that consumers will favor those products that offerthe most quality, performance, or innovative features.',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'product', 'is_correct' => '1'),
                    array('title' => 'marketing', 'is_correct' => '0'),
                    array('title' => 'production', 'is_correct' => '0'),
                    array('title' => 'selling', 'is_correct' => '0'),
                    array('title' => 'holistic marketing', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 2,
                'title' => 'The ________ concept holds that consumers will favor those products that offerthe most quality, performance, or innovative features.',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'product', 'is_correct' => '1'),
                    array('title' => 'marketing', 'is_correct' => '0'),
                    array('title' => 'production', 'is_correct' => '0'),
                    array('title' => 'selling', 'is_correct' => '0'),
                    array('title' => 'holistic marketing', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 2,
                'title' => 'The ________ concept holds that consumers and businesses, if left alone, willordinarily not buy enough of the organization’s products.',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'production', 'is_correct' => '0'),
                    array('title' => 'selling', 'is_correct' => '1'),
                    array('title' => 'marketing', 'is_correct' => '0'),
                    array('title' => 'product', 'is_correct' => '0'),
                    array('title' => 'holistic marketing', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 2,
                'title' => 'In the course of converting to a marketing orientation, a company faces threehurdles—________.',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'organized resistance, slow learning, and fast forgetting', 'is_correct' => '1'),
                    array('title' => 'management, customer reaction, competitive response', 'is_correct' => '0'),
                    array('title' => 'decreased profits, increased R&D, additional distribution', 'is_correct' => '0'),
                    array('title' => 'forecasted demand, increased sales expense, increased inventory costs', 'is_correct' => '0'),
                    array('title' => 'customer focus, profitability, slow learning', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 2,
                'title' => 'Marketers argue for a ________ in which all functions work together to respondto, serve, and satisfy the customer.',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'cross-functional team orientation', 'is_correct' => '0'),
                    array('title' => 'collaboration model', 'is_correct' => '0'),
                    array('title' => 'customer orientation', 'is_correct' => '1'),
                    array('title' => 'management-driven organization', 'is_correct' => '0'),
                    array('title' => 'total quality model', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 2,
                'title' => 'One traditional depiction of marketing activities is in terms of the marketing mixor four Ps. The four Ps are characterized as being ________.',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'product, positioning, place, and price', 'is_correct' => '0'),
                    array('title' => 'product, production, price, and place', 'is_correct' => '0'),
                    array('title' => 'promotion, place, positioning, and price', 'is_correct' => '0'),
                    array('title' => 'place, promotion, production, and positioning', 'is_correct' => '0'),
                    array('title' => 'product, price, promotion, and place', 'is_correct' => '1'),
                ),
            ),
            array(
                'question_category_id' => 2,
                'title' => 'Marketing is not a department so much as a ________.',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'company orientation', 'is_correct' => '1'),
                    array('title' => 'philosophy', 'is_correct' => '0'),
                    array('title' => 'function', 'is_correct' => '0'),
                    array('title' => 'branch of management', 'is_correct' => '0'),
                    array('title' => 'branch of economics', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 2,
                'title' => 'When a customer has a(n) ________ need he/she wants a car whose operatingcost, not its initial price, is low.',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'stated', 'is_correct' => '0'),
                    array('title' => 'real', 'is_correct' => '1'),
                    array('title' => 'unstated', 'is_correct' => '0'),
                    array('title' => 'delight', 'is_correct' => '0'),
                    array('title' => 'secret', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 2,
                'title' => 'When a  customer has  a(n)  ________  need the  customer  wants  to  be seen   byfriends as a savvy consumer.',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'real', 'is_correct' => '0'),
                    array('title' => 'unstated', 'is_correct' => '0'),
                    array('title' => 'delight', 'is_correct' => '0'),
                    array('title' => 'secret', 'is_correct' => '1'),
                    array('title' => 'stated', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 2,
                'title' => '________  reflects   the   perceived   tangible   and   intangible   benefits   and   costs   tocustomers.',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Loyalty', 'is_correct' => '0'),
                    array('title' => 'Satisfaction', 'is_correct' => '0'),
                    array('title' => 'Value', 'is_correct' => '1'),
                    array('title' => 'Expectations', 'is_correct' => '0'),
                    array('title' => 'Comparison shopping', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 3,
                'title' => 'Entomology is the science that studies',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Behavior of human beings', 'is_correct' => '0'),
                    array('title' => 'Insects', 'is_correct' => '1'),
                    array('title' => 'The origin and history of technical and scientific terms', 'is_correct' => '0'),
                    array('title' => 'The formation of rocks', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 3,
                'title' => 'For which of the following disciplines is Nobel Prize awarded?',
                'type' => 'checkbox',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Physics and Chemistry', 'is_correct' => '1'),
                    array('title' => 'Physiology or Medicine', 'is_correct' => '1'),
                    array('title' => 'Literature, Peace and Economics', 'is_correct' => '1'),
                ),
            ),
            array(
                'question_category_id' => 3,
                'title' => 'Galileo was an Italian astronomer who',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'developed the telescope', 'is_correct' => '0'),
                    array('title' => 'discovered four satellites of Jupiter', 'is_correct' => '0'),
                    array('title' => 'discovered that the movement of pendulum produces a regular time measurement', 'is_correct' => '0'),
                    array('title' => 'All of the above', 'is_correct' => '1'),
                ),
            ),
            array(
                'question_category_id' => 3,
                'title' => 'Exposure to sunlight helps a person improve his health because',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'the infrared light kills bacteria in the body', 'is_correct' => '0'),
                    array('title' => 'resistance power increases', 'is_correct' => '0'),
                    array('title' => 'the pigment cells in the skin get stimulated and produce a healthy tan', 'is_correct' => '0'),
                    array('title' => 'the ultraviolet rays convert skin oil into Vitamin D', 'is_correct' => '1'),
                ),
            ),
            array(
                'question_category_id' => 3,
                'title' => 'For the Olympics and World Tournaments, the dimensions of basketball court are',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => '26 m x 14 m', 'is_correct' => '0'),
                    array('title' => '28 m x 15 m', 'is_correct' => '1'),
                    array('title' => '27 m x 16 m', 'is_correct' => '0'),
                    array('title' => '28 m x 16 m', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 3,
                'title' => 'Friction can be reduced by changing from',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'sliding to rolling', 'is_correct' => '1'),
                    array('title' => 'rolling to sliding', 'is_correct' => '0'),
                    array('title' => 'potential energy to kinetic energy', 'is_correct' => '0'),
                    array('title' => 'dynamic to static', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 3,
                'title' => 'Ecology deals with',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Birds', 'is_correct' => '0'),
                    array('title' => 'Cell formation', 'is_correct' => '0'),
                    array('title' => 'Relation between organisms and their environment', 'is_correct' => '1'),
                    array('title' => 'Tissues', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 3,
                'title' => 'Durand Cup is associated with the game of',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Cricket', 'is_correct' => '0'),
                    array('title' => 'Football', 'is_correct' => '1'),
                    array('title' => 'Hockey', 'is_correct' => '0'),
                    array('title' => 'Volleyball', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 3,
                'title' => 'Headquarters of UNO are situated at',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'New York, USA', 'is_correct' => '1'),
                    array('title' => 'Hague (Netherlands)', 'is_correct' => '0'),
                    array('title' => 'Geneva', 'is_correct' => '0'),
                    array('title' => 'Paris', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 3,
                'title' => 'First International Peace Congress was held in London in',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => '1564 AD', 'is_correct' => '0'),
                    array('title' => '1798 AD', 'is_correct' => '0'),
                    array('title' => '1843 AD', 'is_correct' => '1'),
                    array('title' => '1901 AD', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 3,
                'title' => 'For galvanizing iron which of the following metals is used?',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Aluminium', 'is_correct' => '0'),
                    array('title' => 'Copper', 'is_correct' => '0'),
                    array('title' => 'Lead', 'is_correct' => '0'),
                    array('title' => 'Zinc', 'is_correct' => '1'),
                ),
            ),
            array(
                'question_category_id' => 3,
                'title' => 'For purifying drinking water alum is used',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'for coagulation of mud particles', 'is_correct' => '1'),
                    array('title' => 'to kill bacteria', 'is_correct' => '0'),
                    array('title' => 'to remove salts', 'is_correct' => '0'),
                    array('title' => 'to remove gases', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 3,
                'title' => 'In a normal human body, the total number of red blood cells is',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => '15 trillion', 'is_correct' => '0'),
                    array('title' => '20 trillion', 'is_correct' => '0'),
                    array('title' => '25 trillion', 'is_correct' => '0'),
                    array('title' => '30 trillion', 'is_correct' => '1'),
                ),
            ),
            array(
                'question_category_id' => 3,
                'title' => 'In which season do we need more fat?',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Rainy season', 'is_correct' => '0'),
                    array('title' => 'Spring', 'is_correct' => '0'),
                    array('title' => 'Winter', 'is_correct' => '1'),
                    array('title' => 'Summer', 'is_correct' => '0'),
                ),
            ),
            array(
                'question_category_id' => 3,
                'title' => 'How many times has Brazil won the World Cup Football Championship?',
                'type' => 'radio',
                'nature' => 'quiz',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Four times', 'is_correct' => '0'),
                    array('title' => 'Twice', 'is_correct' => '0'),
                    array('title' => 'Five times', 'is_correct' => '1'),
                    array('title' => 'Once', 'is_correct' => '0'),
                ),
            ),
        );
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('questions');
            if ($result->num_rows() <= 0) {
                $answers = $d['answers'];
                unset($d['answers']);
                $this->db->insert('questions', $d);
                $id = $this->db->insert_id();
                foreach ($answers as $answer) {
                    $answer['question_id'] = $id;
                    $this->db->insert('question_answers', $answer);
                }
            }
        }
    }

    public function importQuestions2()
    {
        $data = array(
            array(
                'question_category_id' => 4,
                'title' => 'Tell me a little about yourself.',
                'type' => '',
                'nature' => 'interview',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'question_category_id' => 4,
                'title' => 'What are your biggest weaknesses?',
                'type' => '',
                'nature' => 'interview',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'question_category_id' => 4,
                'title' => 'What are your biggest strengths?',
                'type' => '',
                'nature' => 'interview',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'question_category_id' => 4,
                'title' => 'Where do you see yourself in five years?',
                'type' => '',
                'nature' => 'interview',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'question_category_id' => 4,
                'title' => 'Out of all the other candidates, why should we hire you?',
                'type' => '',
                'nature' => 'interview',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'question_category_id' => 4,
                'title' => 'How did you learn about the opening?',
                'type' => '',
                'nature' => 'interview',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'question_category_id' => 4,
                'title' => 'Why do you want this job?',
                'type' => '',
                'nature' => 'interview',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'question_category_id' => 4,
                'title' => 'What do you consider to be your biggest professional achievement?',
                'type' => '',
                'nature' => 'interview',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'question_category_id' => 4,
                'title' => 'Tell me about the last time a co-worker or customer got angry with you. What happened?',
                'type' => '',
                'nature' => 'interview',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'question_category_id' => 4,
                'title' => 'Describe your dream job.',
                'type' => '',
                'nature' => 'interview',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'question_category_id' => 4,
                'title' => 'Why do you want to leave your current job?',
                'type' => '',
                'nature' => 'interview',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'question_category_id' => 4,
                'title' => 'What kind of work environment do you like best?',
                'type' => '',
                'nature' => 'interview',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'question_category_id' => 4,
                'title' => 'Tell me about the toughest decision you had to make in the last six months.',
                'type' => '',
                'nature' => 'interview',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'question_category_id' => 4,
                'title' => 'What is your leadership style?',
                'type' => '',
                'nature' => 'interview',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'question_category_id' => 4,
                'title' => 'Tell me about a time you disagreed with a decision. What did you do?',
                'type' => '',
                'nature' => 'interview',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'question_category_id' => 4,
                'title' => 'Tell me how you think other people would describe you.',
                'type' => '',
                'nature' => 'interview',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'question_category_id' => 4,
                'title' => 'What can we expect from you in your first three months?',
                'type' => '',
                'nature' => 'interview',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'question_category_id' => 4,
                'title' => 'What do you like to do outside of work?',
                'type' => '',
                'nature' => 'interview',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'question_category_id' => 4,
                'title' => 'What was your salary in your last job?',
                'type' => '',
                'nature' => 'interview',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'question_category_id' => 4,
                'title' => 'A snail is at the bottom of a 30-foot well. Each day he climbs up three feet, but at night he slips back two feet. How many days will it take him to climb out of the well?',
                'type' => '',
                'nature' => 'interview',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'question_category_id' => 4,
                'title' => 'What do you expect me to accomplish in the first 90 days?',
                'type' => '',
                'nature' => 'interview',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'question_category_id' => 4,
                'title' => 'If you were to rank them, what are the three traits your top performers have in common?',
                'type' => '',
                'nature' => 'interview',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'question_category_id' => 4,
                'title' => 'What really drives results in this job?',
                'type' => '',
                'nature' => 'interview',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'question_category_id' => 4,
                'title' => 'What are the company\'s highest-priority goals this year, and how would my role contribute?',
                'type' => '',
                'nature' => 'interview',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'question_category_id' => 4,
                'title' => 'What do you plan to do if...?',
                'type' => '',
                'nature' => 'interview',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
        );
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('questions');
            if ($result->num_rows() <= 0) {
                $this->db->insert('questions', $d);
                $id = $this->db->insert_id();
            }
        }
    }

    public function importQuizCategories()
    {
        $data = array(
            array(
                'title' => 'Entry Level Positions',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Management',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Board',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'General',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
        );
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('quiz_categories');
            if ($result->num_rows() <= 0) {
                $this->db->insert('quiz_categories', $d);
            }
        }
    }

    public function importQuizes()
    {
        $data = array(
            array(
                'quiz_category_id' => 1,
                'title' => 'IT Position Quiz',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
                'allowed_time' => '30',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'quiz_category_id' => 1,
                'title' => 'Marketing Position Quiz',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
                'allowed_time' => '30',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'quiz_category_id' => 4,
                'title' => 'General Knowledge Quiz',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
                'allowed_time' => '30',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
        );
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('quizes');
            if ($result->num_rows() <= 0) {
                $this->db->insert('quizes', $d);
            }
        }
    }

    public function importQuizQuestions()
    {
        $data = array(
            array(
                'quiz_id' => 1,
                'title' => 'A computer basically constitutes of _______ integral components',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Two', 'is_correct' => '0'),
                    array('title' => 'Four', 'is_correct' => '0'),
                    array('title' => 'Three', 'is_correct' => '1'),
                    array('title' => 'Eight', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 1,
                'title' => 'Computers have secondary storage devices known as',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'ALU', 'is_correct' => '0'),
                    array('title' => 'Auxiliary Storage', 'is_correct' => '1'),
                    array('title' => 'CPU', 'is_correct' => '0'),
                    array('title' => 'None of the above', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 1,
                'title' => 'Computers have secondary storage devices known as',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'ALU', 'is_correct' => '0'),
                    array('title' => 'Auxiliary Storage', 'is_correct' => '1'),
                    array('title' => 'CPU', 'is_correct' => '0'),
                    array('title' => 'None of the above', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 1,
                'title' => 'The ____ is responsible for various computer operations',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Memory', 'is_correct' => '0'),
                    array('title' => 'Accumulator (ACU)', 'is_correct' => '0'),
                    array('title' => 'Control Unit', 'is_correct' => '1'),
                    array('title' => 'Memory Address Register (MAR)', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 1,
                'title' => 'Popular microprocessors include',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Intel', 'is_correct' => '1'),
                    array('title' => 'Cache Memory', 'is_correct' => '0'),
                    array('title' => 'AMD', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 1,
                'title' => 'These types of computers are primarily involved in data processing and problem solving for specific programs.',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Compact computers', 'is_correct' => '0'),
                    array('title' => 'Digital computers', 'is_correct' => '1'),
                    array('title' => 'Hybrid computers', 'is_correct' => '0'),
                    array('title' => 'Analog computers', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 1,
                'title' => 'It mediates communication between CPU and other components of system.',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'CPU', 'is_correct' => '0'),
                    array('title' => 'RAM', 'is_correct' => '0'),
                    array('title' => 'Chipset', 'is_correct' => '1'),
                    array('title' => 'Buses', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 1,
                'title' => 'Software that resides on a single computer and does not interact with any other software installed in a different computer.',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Stand Alone Software', 'is_correct' => '1'),
                    array('title' => 'Embedded Software', 'is_correct' => '0'),
                    array('title' => 'Real Time Software', 'is_correct' => '0'),
                    array('title' => 'Network Software', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 1,
                'title' => '____ was the first high level language developed by John Backus at IBM in 1956.',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'FORTRAN', 'is_correct' => '1'),
                    array('title' => 'COBOL', 'is_correct' => '0'),
                    array('title' => 'Basic', 'is_correct' => '0'),
                    array('title' => 'None of the above', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 1,
                'title' => '____ was the first high level language developed by John Backus at IBM in 1956.',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'FORTRAN', 'is_correct' => '1'),
                    array('title' => 'COBOL', 'is_correct' => '0'),
                    array('title' => 'Basic', 'is_correct' => '0'),
                    array('title' => 'None of the above', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 1,
                'title' => '____ is a presentation tool that helps create eye catching and effective presentations in a matter of minutes',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Spreadsheet', 'is_correct' => '0'),
                    array('title' => 'Word Processing', 'is_correct' => '0'),
                    array('title' => 'Bits', 'is_correct' => '0'),
                    array('title' => 'Power Point', 'is_correct' => '1'),
                ),
            ),
            array(
                'quiz_id' => 1,
                'title' => 'The professionals involved in the study and prediction of weather are called.',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Seer', 'is_correct' => '0'),
                    array('title' => 'Doom Sayer', 'is_correct' => '0'),
                    array('title' => 'Meteorologists', 'is_correct' => '1'),
                    array('title' => 'None of the above', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 1,
                'title' => 'The various types of computers are.',
                'type' => 'checkbox',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Personal Computers', 'is_correct' => '1'),
                    array('title' => 'Workstations', 'is_correct' => '1'),
                    array('title' => 'Tablet PC', 'is_correct' => '1'),
                    array('title' => 'Car Dashboard', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 1,
                'title' => 'It is very important for a computer system to have the ability to communicate with the outside world.',
                'type' => 'checkbox',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Receive data', 'is_correct' => '1'),
                    array('title' => 'Send Data', 'is_correct' => '1'),
                    array('title' => 'All of the above', 'is_correct' => '1'),
                ),
            ),
            array(
                'quiz_id' => 1,
                'title' => '1 Gigabyte is equal to',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => '1024 bits', 'is_correct' => '0'),
                    array('title' => '1024 bytes', 'is_correct' => '0'),
                    array('title' => '1024 megabytes', 'is_correct' => '1'),
                    array('title' => '1024 kilobytes', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 1,
                'title' => 'Pen drive is a',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Primary Memory', 'is_correct' => '0'),
                    array('title' => 'Secondary Memory', 'is_correct' => '1'),
                    array('title' => 'Cache Memory', 'is_correct' => '0'),
                    array('title' => 'Internal Memory', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 1,
                'title' => 'How many types of constructors are available, in general, in any language?',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => '2', 'is_correct' => '0'),
                    array('title' => '3', 'is_correct' => '1'),
                    array('title' => '4', 'is_correct' => '0'),
                    array('title' => '5', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 1,
                'title' => 'Which among the following is true for static constructor?',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Static constructors are called with every new object', 'is_correct' => '0'),
                    array('title' => 'Static constructors are used initialize data members to zero always', 'is_correct' => '0'),
                    array('title' => 'Static constructors can’t be parameterized constructors', 'is_correct' => '1'),
                    array('title' => 'Static constructors can be used to initialize the non-static members also', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 1,
                'title' => 'Within a class, only one static constructor can be created.',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'True', 'is_correct' => '1'),
                    array('title' => 'False', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 1,
                'title' => 'Why do we use constructor overloading?',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'To use different types of constructors', 'is_correct' => '0'),
                    array('title' => 'Because it’s a feature provided', 'is_correct' => '0'),
                    array('title' => 'To initialize the object in different ways', 'is_correct' => '1'),
                    array('title' => 'To differentiate one constructor from another', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 1,
                'title' => 'The destructor can be called before the constructor if required.',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'True', 'is_correct' => '0'),
                    array('title' => 'False', 'is_correct' => '1'),
                ),
            ),
            array(
                'quiz_id' => 1,
                'title' => ' If in multiple inheritance, class C inherits class B, and Class B inherits class A. In which sequence are their destructors called if an object of class C was declared?',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => '~C() then ~B() then ~A()', 'is_correct' => '1'),
                    array('title' => '~B() then ~C() then ~A()', 'is_correct' => '0'),
                    array('title' => '~A() then ~B() then ~C()', 'is_correct' => '0'),
                    array('title' => '~C() then ~A() then ~B()', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 2,
                'title' => 'Good marketing is no accident, but a result of careful planning and ________',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'execution', 'is_correct' => '1'),
                    array('title' => 'selling', 'is_correct' => '0'),
                    array('title' => 'strategies', 'is_correct' => '0'),
                    array('title' => 'tactics', 'is_correct' => '0'),
                    array('title' => 'research', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 2,
                'title' => 'The most formal definition of marketing is ________',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'meeting needs profitably', 'is_correct' => '0'),
                    array('title' => 'identifying and meeting human and social needs', 'is_correct' => '0'),
                    array('title' => 'the 4Ps (Product, Price, Place, Promotion)', 'is_correct' => '0'),
                    array('title' => 'an organizational function and a set of processes for creating, communicating,and delivering, value to customers, and for managing customer relationships inways that benefit the organization and its stake holders', 'is_correct' => '1'),
                    array('title' => 'improving the quality of life for consumers', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 2,
                'title' => '________ can be produced and marketed as a product.',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Information', 'is_correct' => '1'),
                    array('title' => 'Celebrities', 'is_correct' => '0'),
                    array('title' => 'Durable goods', 'is_correct' => '0'),
                    array('title' => 'Organizations', 'is_correct' => '0'),
                    array('title' => 'Properties', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 2,
                'title' => 'The   ________   promises   to   lead   to   more   accurate   levels   of   production,   moretargeted communications, and more relevant pricing.',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Age of Globalization', 'is_correct' => '0'),
                    array('title' => 'Age of Deregulation', 'is_correct' => '0'),
                    array('title' => 'Industrial Age', 'is_correct' => '0'),
                    array('title' => 'Information Ag', 'is_correct' => '1'),
                    array('title' => 'Production Age', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 2,
                'title' => 'Marketers often use the term ________ to cover various groupings of customers.',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'people', 'is_correct' => '0'),
                    array('title' => 'buying power', 'is_correct' => '0'),
                    array('title' => 'demographic segment', 'is_correct' => '0'),
                    array('title' => 'social class position', 'is_correct' => '0'),
                    array('title' => 'market', 'is_correct' => '1'),
                ),
            ),
            array(
                'quiz_id' => 2,
                'title' => 'Customers are showing greater price sensitivity in their search for ________',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'The right product', 'is_correct' => '0'),
                    array('title' => 'The right service', 'is_correct' => '0'),
                    array('title' => 'The right store', 'is_correct' => '0'),
                    array('title' => 'Value', 'is_correct' => '1'),
                    array('title' => 'Relationships', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 2,
                'title' => 'The ________ concept holds that consumers will favor those products that offerthe most quality, performance, or innovative features.',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'product', 'is_correct' => '1'),
                    array('title' => 'marketing', 'is_correct' => '0'),
                    array('title' => 'production', 'is_correct' => '0'),
                    array('title' => 'selling', 'is_correct' => '0'),
                    array('title' => 'holistic marketing', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 2,
                'title' => 'The ________ concept holds that consumers will favor those products that offerthe most quality, performance, or innovative features.',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'product', 'is_correct' => '1'),
                    array('title' => 'marketing', 'is_correct' => '0'),
                    array('title' => 'production', 'is_correct' => '0'),
                    array('title' => 'selling', 'is_correct' => '0'),
                    array('title' => 'holistic marketing', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 2,
                'title' => 'The ________ concept holds that consumers and businesses, if left alone, willordinarily not buy enough of the organization’s products.',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'production', 'is_correct' => '0'),
                    array('title' => 'selling', 'is_correct' => '1'),
                    array('title' => 'marketing', 'is_correct' => '0'),
                    array('title' => 'product', 'is_correct' => '0'),
                    array('title' => 'holistic marketing', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 2,
                'title' => 'In the course of converting to a marketing orientation, a company faces threehurdles—________.',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'organized resistance, slow learning, and fast forgetting', 'is_correct' => '1'),
                    array('title' => 'management, customer reaction, competitive response', 'is_correct' => '0'),
                    array('title' => 'decreased profits, increased R&D, additional distribution', 'is_correct' => '0'),
                    array('title' => 'forecasted demand, increased sales expense, increased inventory costs', 'is_correct' => '0'),
                    array('title' => 'customer focus, profitability, slow learning', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 2,
                'title' => 'Marketers argue for a ________ in which all functions work together to respondto, serve, and satisfy the customer.',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'cross-functional team orientation', 'is_correct' => '0'),
                    array('title' => 'collaboration model', 'is_correct' => '0'),
                    array('title' => 'customer orientation', 'is_correct' => '1'),
                    array('title' => 'management-driven organization', 'is_correct' => '0'),
                    array('title' => 'total quality model', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 2,
                'title' => 'One traditional depiction of marketing activities is in terms of the marketing mixor four Ps. The four Ps are characterized as being ________.',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'product, positioning, place, and price', 'is_correct' => '0'),
                    array('title' => 'product, production, price, and place', 'is_correct' => '0'),
                    array('title' => 'promotion, place, positioning, and price', 'is_correct' => '0'),
                    array('title' => 'place, promotion, production, and positioning', 'is_correct' => '0'),
                    array('title' => 'product, price, promotion, and place', 'is_correct' => '1'),
                ),
            ),
            array(
                'quiz_id' => 2,
                'title' => 'Marketing is not a department so much as a ________.',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'company orientation', 'is_correct' => '1'),
                    array('title' => 'philosophy', 'is_correct' => '0'),
                    array('title' => 'function', 'is_correct' => '0'),
                    array('title' => 'branch of management', 'is_correct' => '0'),
                    array('title' => 'branch of economics', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 2,
                'title' => 'When a customer has a(n) ________ need he/she wants a car whose operatingcost, not its initial price, is low.',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'stated', 'is_correct' => '0'),
                    array('title' => 'real', 'is_correct' => '1'),
                    array('title' => 'unstated', 'is_correct' => '0'),
                    array('title' => 'delight', 'is_correct' => '0'),
                    array('title' => 'secret', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 2,
                'title' => 'When a  customer has  a(n)  ________  need the  customer  wants  to  be seen   byfriends as a savvy consumer.',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'real', 'is_correct' => '0'),
                    array('title' => 'unstated', 'is_correct' => '0'),
                    array('title' => 'delight', 'is_correct' => '0'),
                    array('title' => 'secret', 'is_correct' => '1'),
                    array('title' => 'stated', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 2,
                'title' => '________  reflects   the   perceived   tangible   and   intangible   benefits   and   costs   tocustomers.',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Loyalty', 'is_correct' => '0'),
                    array('title' => 'Satisfaction', 'is_correct' => '0'),
                    array('title' => 'Value', 'is_correct' => '1'),
                    array('title' => 'Expectations', 'is_correct' => '0'),
                    array('title' => 'Comparison shopping', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 3,
                'title' => 'Entomology is the science that studies',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Behavior of human beings', 'is_correct' => '0'),
                    array('title' => 'Insects', 'is_correct' => '1'),
                    array('title' => 'The origin and history of technical and scientific terms', 'is_correct' => '0'),
                    array('title' => 'The formation of rocks', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 3,
                'title' => 'For which of the following disciplines is Nobel Prize awarded?',
                'type' => 'checkbox',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Physics and Chemistry', 'is_correct' => '1'),
                    array('title' => 'Physiology or Medicine', 'is_correct' => '1'),
                    array('title' => 'Literature, Peace and Economics', 'is_correct' => '1'),
                ),
            ),
            array(
                'quiz_id' => 3,
                'title' => 'Galileo was an Italian astronomer who',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'developed the telescope', 'is_correct' => '0'),
                    array('title' => 'discovered four satellites of Jupiter', 'is_correct' => '0'),
                    array('title' => 'discovered that the movement of pendulum produces a regular time measurement', 'is_correct' => '0'),
                    array('title' => 'All of the above', 'is_correct' => '1'),
                ),
            ),
            array(
                'quiz_id' => 3,
                'title' => 'Exposure to sunlight helps a person improve his health because',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'the infrared light kills bacteria in the body', 'is_correct' => '0'),
                    array('title' => 'resistance power increases', 'is_correct' => '0'),
                    array('title' => 'the pigment cells in the skin get stimulated and produce a healthy tan', 'is_correct' => '0'),
                    array('title' => 'the ultraviolet rays convert skin oil into Vitamin D', 'is_correct' => '1'),
                ),
            ),
            array(
                'quiz_id' => 3,
                'title' => 'For the Olympics and World Tournaments, the dimensions of basketball court are',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => '26 m x 14 m', 'is_correct' => '0'),
                    array('title' => '28 m x 15 m', 'is_correct' => '1'),
                    array('title' => '27 m x 16 m', 'is_correct' => '0'),
                    array('title' => '28 m x 16 m', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 3,
                'title' => 'Friction can be reduced by changing from',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'sliding to rolling', 'is_correct' => '1'),
                    array('title' => 'rolling to sliding', 'is_correct' => '0'),
                    array('title' => 'potential energy to kinetic energy', 'is_correct' => '0'),
                    array('title' => 'dynamic to static', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 3,
                'title' => 'Ecology deals with',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Birds', 'is_correct' => '0'),
                    array('title' => 'Cell formation', 'is_correct' => '0'),
                    array('title' => 'Relation between organisms and their environment', 'is_correct' => '1'),
                    array('title' => 'Tissues', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 3,
                'title' => 'Durand Cup is associated with the game of',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Cricket', 'is_correct' => '0'),
                    array('title' => 'Football', 'is_correct' => '1'),
                    array('title' => 'Hockey', 'is_correct' => '0'),
                    array('title' => 'Volleyball', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 3,
                'title' => 'Headquarters of UNO are situated at',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'New York, USA', 'is_correct' => '1'),
                    array('title' => 'Hague (Netherlands)', 'is_correct' => '0'),
                    array('title' => 'Geneva', 'is_correct' => '0'),
                    array('title' => 'Paris', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 3,
                'title' => 'First International Peace Congress was held in London in',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => '1564 AD', 'is_correct' => '0'),
                    array('title' => '1798 AD', 'is_correct' => '0'),
                    array('title' => '1843 AD', 'is_correct' => '1'),
                    array('title' => '1901 AD', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 3,
                'title' => 'For galvanizing iron which of the following metals is used?',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Aluminium', 'is_correct' => '0'),
                    array('title' => 'Copper', 'is_correct' => '0'),
                    array('title' => 'Lead', 'is_correct' => '0'),
                    array('title' => 'Zinc', 'is_correct' => '1'),
                ),
            ),
            array(
                'quiz_id' => 3,
                'title' => 'For purifying drinking water alum is used',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'for coagulation of mud particles', 'is_correct' => '1'),
                    array('title' => 'to kill bacteria', 'is_correct' => '0'),
                    array('title' => 'to remove salts', 'is_correct' => '0'),
                    array('title' => 'to remove gases', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 3,
                'title' => 'In a normal human body, the total number of red blood cells is',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => '15 trillion', 'is_correct' => '0'),
                    array('title' => '20 trillion', 'is_correct' => '0'),
                    array('title' => '25 trillion', 'is_correct' => '0'),
                    array('title' => '30 trillion', 'is_correct' => '1'),
                ),
            ),
            array(
                'quiz_id' => 3,
                'title' => 'In which season do we need more fat?',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Rainy season', 'is_correct' => '0'),
                    array('title' => 'Spring', 'is_correct' => '0'),
                    array('title' => 'Winter', 'is_correct' => '1'),
                    array('title' => 'Summer', 'is_correct' => '0'),
                ),
            ),
            array(
                'quiz_id' => 3,
                'title' => 'How many times has Brazil won the World Cup Football Championship?',
                'type' => 'radio',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'answers' => array(
                    array('title' => 'Four times', 'is_correct' => '0'),
                    array('title' => 'Twice', 'is_correct' => '0'),
                    array('title' => 'Five times', 'is_correct' => '1'),
                    array('title' => 'Once', 'is_correct' => '0'),
                ),
            ),
        );
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('quiz_questions');
            if ($result->num_rows() <= 0) {
                $answers = $d['answers'];
                unset($d['answers']);
                $this->db->insert('quiz_questions', $d);
                $id = $this->db->insert_id();
                foreach ($answers as $answer) {
                    $answer['quiz_question_id'] = $id;
                    $this->db->insert('quiz_question_answers', $answer);
                }
            }
        }
    }

    public function importInterviewCategories()
    {
        $data = array(
            array(
                'title' => 'Entry Level Positions',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Management',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Board',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'General',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
        );
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('interview_categories');
            if ($result->num_rows() <= 0) {
                $this->db->insert('interview_categories', $d);
            }
        }
    }

    public function importInterviews()
    {
        $data = array(
            array(
                'interview_category_id' => 1,
                'title' => 'IT Position Interview',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'interview_category_id' => 1,
                'title' => 'Marketing Position Interview',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'interview_category_id' => 4,
                'title' => 'General Interview',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
        );
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('interviews');
            if ($result->num_rows() <= 0) {
                $this->db->insert('interviews', $d);
            }
        }
    }

    public function importInterviewQuestions()
    {
        $data = array(
            array(
                'interview_id' => 3,
                'title' => 'Tell me a little about yourself.',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'interview_id' => 3,
                'title' => 'What are your biggest weaknesses?',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'interview_id' => 3,
                'title' => 'What are your biggest strengths?',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'interview_id' => 3,
                'title' => 'Where do you see yourself in five years?',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'interview_id' => 3,
                'title' => 'Out of all the other candidates, why should we hire you?',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'interview_id' => 3,
                'title' => 'How did you learn about the opening?',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'interview_id' => 3,
                'title' => 'Why do you want this job?',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'interview_id' => 3,
                'title' => 'What do you consider to be your biggest professional achievement?',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'interview_id' => 3,
                'title' => 'Tell me about the last time a co-worker or customer got angry with you. What happened?',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'interview_id' => 3,
                'title' => 'Describe your dream job.',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'interview_id' => 3,
                'title' => 'Why do you want to leave your current job?',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'interview_id' => 3,
                'title' => 'What kind of work environment do you like best?',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'interview_id' => 3,
                'title' => 'Tell me about the toughest decision you had to make in the last six months.',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'interview_id' => 3,
                'title' => 'What is your leadership style?',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'interview_id' => 3,
                'title' => 'Tell me about a time you disagreed with a decision. What did you do?',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'interview_id' => 3,
                'title' => 'Tell me how you think other people would describe you.',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'interview_id' => 3,
                'title' => 'What can we expect from you in your first three months?',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'interview_id' => 3,
                'title' => 'What do you like to do outside of work?',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'interview_id' => 3,
                'title' => 'What was your salary in your last job?',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'interview_id' => 3,
                'title' => 'A snail is at the bottom of a 30-foot well. Each day he climbs up three feet, but at night he slips back two feet. How many days will it take him to climb out of the well?',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'interview_id' => 3,
                'title' => 'What do you expect me to accomplish in the first 90 days?',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'interview_id' => 3,
                'title' => 'If you were to rank them, what are the three traits your top performers have in common?',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'interview_id' => 3,
                'title' => 'What really drives results in this job?',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'interview_id' => 3,
                'title' => 'What are the company\'s highest-priority goals this year, and how would my role contribute?',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'interview_id' => 3,
                'title' => 'What do you plan to do if...?',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
        );        
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('interview_questions');
            if ($result->num_rows() <= 0) {
                $this->db->insert('interview_questions', $d);
                $id = $this->db->insert_id();
            }
        }
    }


}