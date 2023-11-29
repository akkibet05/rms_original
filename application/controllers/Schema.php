<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schema extends CI_Controller {

    public function run()
    {
        $this->SchemaModel->run();
        $this->SchemaQuestionsModel->run();
    }

    public function data()
    {
        ini_set('max_execution_time', '1000');
        $this->DataQuestionsModel->run();
        $this->DataModel->run();
    }
}
