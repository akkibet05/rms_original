<?php

class DataModel extends CI_Model
{
    public function __construct()
    {
        $this->load->dbforge();
    }

    public function run()
    {
        $this->importUsersData();
        $this->importCandidatesData();
        $this->importRolesData();
        $this->importDepartmentsData();
        $this->importCompaniesData();
        $this->importTraitsData();
        $this->importJobsData();
        $this->importJobFavoritesData();
        $this->importJobReferredData();
        $this->importJobFilters();
        $this->importBlogCategoriesData();
        $this->importBlogsData();
        $this->importResumeData();
        $this->importToDos();
    }

    public function importUsersData()
    {
        $data = array(
            array(
                'first_name' => 'Admin',
                'last_name' => 'User',
                'username' => 'admin',
                'email' => 'admin@cf.com',
                'image' => '',
                'phone' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'user_type' => 'admin',
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Liam',
                'last_name' => 'Logan',
                'username' => 'liam',
                'email' => 'liam@cf.com',
                'image' => '',
                'phone' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'user_type' => 'team',
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'William',
                'last_name' => 'Amith',
                'username' => 'william',
                'email' => 'william@cf.com',
                'image' => '',
                'phone' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'user_type' => 'team',
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Oliver',
                'last_name' => 'Wood',
                'username' => 'oliver',
                'email' => 'oliver@cf.com',
                'image' => '',
                'phone' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'user_type' => 'team',
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Brad',
                'last_name' => 'Pitt',
                'username' => 'brad',
                'email' => 'brad@cf.com',
                'image' => '',
                'phone' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'user_type' => 'team',
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Neil',
                'last_name' => 'Armstrong',
                'username' => 'neil',
                'email' => 'neil@cf.com',
                'image' => '',
                'phone' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'user_type' => 'team',
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Anthony',
                'last_name' => 'Hopkins',
                'username' => 'anthony',
                'email' => 'anthony@cf.com',
                'image' => '',
                'phone' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'user_type' => 'team',
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Fredrick',
                'last_name' => 'John',
                'username' => 'john',
                'email' => 'john@cf.com',
                'image' => '',
                'phone' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'user_type' => 'team',
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Virat',
                'last_name' => 'Anand',
                'username' => 'virat',
                'email' => 'anand@cf.com',
                'image' => '',
                'phone' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'user_type' => 'team',
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Ali',
                'last_name' => 'Moeen',
                'username' => 'ali',
                'email' => 'ali.moeen@cf.com',
                'image' => '',
                'phone' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'user_type' => 'team',
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Victoria',
                'last_name' => 'Joseph',
                'username' => 'team',
                'email' => 'victoria@cf.com',
                'image' => '',
                'phone' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'user_type' => 'team',
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Mahima',
                'last_name' => 'Khan',
                'username' => 'khan',
                'email' => 'khan@cf.com',
                'image' => '',
                'phone' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'user_type' => 'team',
                'created_at' => date('Y-m-d G:i:s'),
            ),
        );
        foreach ($data as $d) {
            $this->db->group_start()->where('username', $d['username'])->or_where('email', $d['email'])->group_end();
            $result = $this->db->get('users');
            if ($result->num_rows() <= 0) {
                $this->db->insert('users', $d);
                $id = $this->db->insert_id();
            }
        }
    }

    public function importCandidatesData()
    {
        $data = array(
            array(
                'first_name' => 'Josh',
                'last_name' => 'Kent',
                'email' => 'josh@cf.com',
                'image' => '',
                'phone1' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Candidate',
                'last_name' => '',
                'email' => 'candidate@cf.com',
                'image' => '2.png',
                'phone1' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'William',
                'last_name' => 'Amith',
                'email' => 'william@cf.com',
                'image' => '3.png',
                'phone1' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Kristen',
                'last_name' => 'Wood',
                'email' => 'oliver@cf.com',
                'image' => '4.png',
                'phone1' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Brad',
                'last_name' => 'Pitt',
                'email' => 'brad@cf.com',
                'image' => '6.png',
                'phone1' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Neil',
                'last_name' => 'Armstrong',
                'email' => 'neil@cf.com',
                'image' => '7.png',
                'phone1' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Anthony',
                'last_name' => 'Hopkins',
                'email' => 'anthony@cf.com',
                'image' => '8.png',
                'phone1' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Fredrick',
                'last_name' => 'John',
                'email' => 'john@cf.com',
                'image' => '9.png',
                'phone1' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Virat',
                'last_name' => 'Anand',
                'email' => 'anand@cf.com',
                'image' => '',
                'phone1' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Ali',
                'last_name' => 'Moeen',
                'email' => 'ali.moeen@cf.com',
                'image' => '',
                'phone1' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Victoria',
                'last_name' => 'Joseph',
                'email' => 'victoria@cf.com',
                'image' => '5.png',
                'phone1' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'first_name' => 'Mahima',
                'last_name' => 'Khan',
                'email' => 'khan@cf.com',
                'image' => '',
                'phone1' => '',
                'password' => '68abad1f89c848faebe47091382aacf4f89c848fa',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
            ),
        );
        foreach ($data as $d) {
            $this->db->where('email', $d['email']);
            $result = $this->db->get('candidates');
            if ($result->num_rows() <= 0) {
                $this->db->insert('candidates', $d);
                $id = $this->db->insert_id();
            }
        }
    }

    public function importRolesData()
    {
        $data = array(
            array(
                'title' => 'Super Admin',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Interviewer',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'News Manager',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Quiz Designer',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Site Controller',
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
        );
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('roles');
            if ($result->num_rows() <= 0) {
                $this->db->insert('roles', $d);
                $id = $this->db->insert_id();
            }
        }
    }

    public function importDepartmentsData()
    {
        $data = array(
            array(
                'title' => 'Finance',
                'image' => 'finance.png',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Accounting',
                'image' => 'accounting.png',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Administration',
                'image' => 'administration.png',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Marketing',
                'image' => 'marketing.png',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Human Resource',
                'image' => 'human-resource.png',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Information Technology',
                'image' => 'information-tech.png',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Advertising',
                'image' => 'advertising.png',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Business Development',
                'image' => 'business-dev.png',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Customer Service',
                'image' => 'customer-service.png',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Maintenance',
                'image' => 'maintenance.png',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Procurement',
                'image' => 'procurement.png',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Sales',
                'image' => 'sales.png',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
        );
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('departments');
            if ($result->num_rows() <= 0) {
                $this->db->insert('departments', $d);
                $id = $this->db->insert_id();
            }
        }
    }

    public function importResumeData()
    {
        $data = array(
            array(
                'candidate_id' => '1',
                'title' => 'My Resume 1',
                'designation' => 'Marketing Manager',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Intern', 'company' => 'ABC Company', 'from' => '2015-01-01', 'to' => '2018-12-30'),
                    array('title' => 'Executive', 'company' => 'EFG Inc.', 'from' => '2019-01-01', 'to' => '2019-03-30'),
                    array('title' => 'Manager', 'company' => 'XYZ Corp.', 'from' => '2019-04-01', 'to' => '2020-02-15'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Masters','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'skills' => array(
                    array('title' => 'Presentation', 'proficiency' => 'beginner'),
                    array('title' => 'MS Office', 'proficiency' => 'intermediate'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'native'),
                    array('title' => 'French', 'proficiency' => 'beginner'),
                    array('title' => 'German', 'proficiency' => 'intermediate'),
                    array('title' => 'German2', 'proficiency' => 'intermediate'),
                )
            ),
            array(
                'candidate_id' => '2',
                'title' => 'My Resume 2',
                'designation' => 'Marketing Executive',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',                
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Intern', 'company' => 'ABC Company', 'from' => '2015-01-01', 'to' => '2016-12-30'),
                    array('title' => 'Executive', 'company' => 'EFG Inc.', 'from' => '2016-01-01', 'to' => '2017-12-30'),
                    array('title' => 'Manager', 'company' => 'XYZ Corp.', 'from' => '2018-01-01', 'to' => '2019-12-15'),
                    array('title' => 'Sr. Manager', 'company' => 'XYZ Corp 2.', 'from' => '2019-04-01', 'to' => '2020-10-15'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Masters','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                    array('title' => 'P.H.D.','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'skills' => array(
                    array('title' => 'Presentation', 'proficiency' => 'beginner'),
                    array('title' => 'MS Office', 'proficiency' => 'intermediate'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'native'),
                    array('title' => 'French', 'proficiency' => 'beginner'),
                )
            ),
            array(
                'candidate_id' => '3',
                'title' => 'My Resume 3',
                'designation' => 'Public Relations Manager',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',                
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Intern', 'company' => 'ABC Company', 'from' => '2015-01-01', 'to' => '2018-12-30'),
                    array('title' => 'Manager', 'company' => 'XYZ Corp.', 'from' => '2019-04-01', 'to' => '2020-02-15'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'skills' => array(
                    array('title' => 'Presentation', 'proficiency' => 'beginner'),
                    array('title' => 'MS Office', 'proficiency' => 'intermediate'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'native'),
                    array('title' => 'English 2', 'proficiency' => 'native'),
                    array('title' => 'French', 'proficiency' => 'beginner'),
                    array('title' => 'French 2', 'proficiency' => 'beginner'),
                    array('title' => 'German', 'proficiency' => 'intermediate'),
                )
            ),
            array(
                'candidate_id' => '4',
                'title' => 'My Resume 4',
                'designation' => 'Business Developer',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',                
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Intern', 'company' => 'ABC Company', 'from' => '2015-01-01', 'to' => '2018-12-30'),
                    array('title' => 'Executive', 'company' => 'EFG Inc.', 'from' => '2019-01-01', 'to' => '2019-03-30'),
                    array('title' => 'Manager', 'company' => 'XYZ Corp.', 'from' => '2019-04-01', 'to' => '2020-02-15'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Masters','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                    array('title' => 'P.H.D.','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),                
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'skills' => array(
                    array('title' => 'Presentation', 'proficiency' => 'beginner'),
                    array('title' => 'MS Office', 'proficiency' => 'intermediate'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'native'),
                    array('title' => 'German', 'proficiency' => 'intermediate'),
                )
            ),
            array(
                'candidate_id' => '5',
                'title' => 'My Resume 5',
                'designation' => 'Manager Market Operations',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',                
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Intern', 'company' => 'ABC Company', 'from' => '2017-06-01', 'to' => '2018-12-30'),
                    array('title' => 'Executive', 'company' => 'EFG Inc.', 'from' => '2019-02-01', 'to' => '2019-08-30'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Masters','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                    array('title' => 'Certification','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'skills' => array(
                    array('title' => 'Presentation', 'proficiency' => 'beginner'),
                    array('title' => 'MS Office', 'proficiency' => 'intermediate'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'native'),
                    array('title' => 'French', 'proficiency' => 'beginner'),
                    array('title' => 'German', 'proficiency' => 'intermediate'),
                )
            ),
            array(
                'candidate_id' => '6',
                'title' => 'My Resume 6',
                'designation' => 'Regional Sales Manager',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',                
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Intern', 'company' => 'ABC Company', 'from' => '2012-01-01', 'to' => '2015-12-30'),
                    array('title' => 'Executive', 'company' => 'EFG Inc.', 'from' => '2016-04-01', 'to' => '2018-09-30'),
                    array('title' => 'Manager', 'company' => 'XYZ Corp.', 'from' => '2019-04-01', 'to' => '2020-02-15'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'skills' => array(
                    array('title' => 'Presentation', 'proficiency' => 'beginner'),
                    array('title' => 'MS Office', 'proficiency' => 'intermediate'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'native'),
                    array('title' => 'French', 'proficiency' => 'beginner'),
                    array('title' => 'German', 'proficiency' => 'intermediate'),
                )
            ),
            array(
                'candidate_id' => '7',
                'title' => 'My Resume 7',
                'designation' => 'Business Developer',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',                
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Intern', 'company' => 'ABC Company', 'from' => '2016-01-01', 'to' => '2018-12-30'),
                    array('title' => 'Manager', 'company' => 'XYZ Corp.', 'from' => '2019-05-01', 'to' => '2019-10-30'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'skills' => array(
                    array('title' => 'Presentation', 'proficiency' => 'beginner'),
                    array('title' => 'MS Office', 'proficiency' => 'intermediate'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'native'),
                    array('title' => 'French', 'proficiency' => 'beginner'),
                    array('title' => 'German', 'proficiency' => 'intermediate'),
                )
            ),
            array(
                'candidate_id' => '8',
                'title' => 'My Resume 8',
                'designation' => 'Marketeer',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',                
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Executive', 'company' => 'EFG Inc.', 'from' => '2011-01-01', 'to' => '2016-03-30'),
                    array('title' => 'Manager', 'company' => 'XYZ Corp.', 'from' => '2017-04-01', 'to' => '2020-02-15'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'skills' => array(
                    array('title' => 'Presentation', 'proficiency' => 'beginner'),
                    array('title' => 'MS Office', 'proficiency' => 'intermediate'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'native'),
                    array('title' => 'French', 'proficiency' => 'beginner'),
                    array('title' => 'German', 'proficiency' => 'intermediate'),
                )
            ),
            array(
                'candidate_id' => '9',
                'title' => 'My Resume 9',
                'designation' => 'Business Developer',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',                
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Intern', 'company' => 'ABC Company', 'from' => '2015-01-01', 'to' => '2018-12-30'),
                    array('title' => 'Executive', 'company' => 'EFG Inc.', 'from' => '2019-01-01', 'to' => '2019-03-30'),
                    array('title' => 'Manager', 'company' => 'XYZ Corp.', 'from' => '2019-04-01', 'to' => '2020-02-15'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Masters','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'skills' => array(
                    array('title' => 'Presentation', 'proficiency' => 'beginner'),
                    array('title' => 'MS Office', 'proficiency' => 'intermediate'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'native'),
                    array('title' => 'French', 'proficiency' => 'beginner'),
                    array('title' => 'German', 'proficiency' => 'intermediate'),
                )
            ),
            array(
                'candidate_id' => '10',
                'title' => 'My Resume 10',
                'designation' => 'Marketing Manager',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',                
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Intern', 'company' => 'ABC Company', 'from' => '2011-01-01', 'to' => '2013-12-30'),
                    array('title' => 'Executive', 'company' => 'EFG Inc.', 'from' => '2014-01-01', 'to' => '2016-03-30'),
                    array('title' => 'Manager', 'company' => 'XYZ Corp.', 'from' => '2017-04-01', 'to' => '2018-02-15'),
                    array('title' => 'Sr. Manager', 'company' => 'XYZ Corp.', 'from' => '2019-04-01', 'to' => '2020-02-15'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Masters','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                    array('title' => 'Doctorate','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'skills' => array(
                    array('title' => 'Presentation', 'proficiency' => 'beginner'),
                    array('title' => 'MS Office', 'proficiency' => 'intermediate'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'native'),
                    array('title' => 'French', 'proficiency' => 'beginner'),
                    array('title' => 'German', 'proficiency' => 'intermediate'),
                )
            ),
            array(
                'candidate_id' => '11',
                'title' => 'My Resume 11',
                'designation' => 'Area Sales Manager',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',                
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Intern', 'company' => 'ABC Company', 'from' => '2015-01-01', 'to' => '2018-12-30'),
                    array('title' => 'Executive', 'company' => 'EFG Inc.', 'from' => '2019-01-01', 'to' => '2019-03-30'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Masters','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'skills' => array(
                    array('title' => 'Presentation', 'proficiency' => 'beginner'),
                    array('title' => 'MS Office', 'proficiency' => 'intermediate'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'native'),
                    array('title' => 'French', 'proficiency' => 'beginner'),
                    array('title' => 'German', 'proficiency' => 'intermediate'),
                )
            ),
            array(
                'candidate_id' => '12',
                'title' => 'My Resume 12',
                'designation' => 'Marketing Supervisor',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',                
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Executive', 'company' => 'EFG Inc.', 'from' => '2019-01-01', 'to' => '2019-03-30'),
                    array('title' => 'Manager', 'company' => 'XYZ Corp.', 'from' => '2019-04-01', 'to' => '2020-02-15'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Masters','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                    array('title' => 'M Phil.','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'skills' => array(
                    array('title' => 'Presentation', 'proficiency' => 'beginner'),
                    array('title' => 'MS Office', 'proficiency' => 'intermediate'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'beginner'),
                    array('title' => 'French', 'proficiency' => 'native'),
                    array('title' => 'German', 'proficiency' => 'intermediate'),
                )
            ),
            array(
                'candidate_id' => '5',
                'title' => 'My Resume 13',
                'designation' => 'Network Administrator',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',                
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Executive', 'company' => 'EFG Inc.', 'from' => '2019-01-01', 'to' => '2019-03-30'),
                    array('title' => 'Manager', 'company' => 'XYZ Corp.', 'from' => '2019-04-01', 'to' => '2020-02-15'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Masters','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                    array('title' => 'M Phil.','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'skills' => array(
                    array('title' => 'Presentation', 'proficiency' => 'beginner'),
                    array('title' => 'MS Office', 'proficiency' => 'intermediate'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'beginner'),
                    array('title' => 'French', 'proficiency' => 'native'),
                    array('title' => 'German', 'proficiency' => 'intermediate'),
                )
            ),
            array(
                'candidate_id' => '6',
                'title' => 'My Resume 14',
                'designation' => 'System Software Architect',
                'objective' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',                
                'status' => 1,
                'experiences' => array(
                    array('title' => 'Executive', 'company' => 'EFG Inc.', 'from' => '2019-01-01', 'to' => '2019-03-30'),
                    array('title' => 'Manager', 'company' => 'XYZ Corp.', 'from' => '2019-04-01', 'to' => '2020-02-15'),
                ),
                'qualifications' => array(
                    array('title' => 'Graduation','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2011-01-01','to'=>'2015-12-30'),
                    array('title' => 'Masters','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                    array('title' => 'M Phil.','institution' => 'ABC College','marks' => '3.5','out_of' => '4.0','from' => '2016-01-01','to'=>'2018-12-30'),
                ),
                'achievements' => array(
                    array('title' => 'Certificate','link' => 'http://www.example.com','type' => 'certificate','date' => '2018-06-15','description' => 'Dummy Description'),
                ),
                'references' => array(
                    array('title' => 'Mr. Person','Relation' => 'Immediate Boss','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person@examplecf.com'),
                    array('title' => 'Mr. Person 2','Relation' => 'Colleague','company' => 'ABC Corp.','phone' => '1234567890','email' => 'mr.person.2@examplecf.com'),
                ),
                'skills' => array(
                    array('title' => 'Presentation', 'proficiency' => 'beginner'),
                    array('title' => 'MS Office', 'proficiency' => 'intermediate'),
                ),
                'languages' => array(
                    array('title' => 'English', 'proficiency' => 'beginner'),
                    array('title' => 'French', 'proficiency' => 'native'),
                    array('title' => 'German', 'proficiency' => 'intermediate'),
                )
            ),
        );
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $this->db->where('candidate_id', $d['candidate_id']);
            $result = $this->db->get('resumes');
            if ($result->num_rows() <= 0) {
                //Separting dependents
                $experiences = $d['experiences'];
                $qualifications = $d['qualifications'];
                $achievements = $d['achievements'];
                $references = $d['references'];
                $languages = $d['languages'];
                $skills = $d['skills'];
                unset($d['experiences'],$d['qualifications'],$d['achievements'],$d['references'],$d['skills'],$d['languages']);

                $d['updated_at'] = date('Y-m-d G:i:s');
                $d['created_at'] = date('Y-m-d G:i:s');
                $d['type'] = 'detailed';
                $d['experience'] = getExprienceInMonths($experiences);
                $d['experiences'] = count($experiences);
                $d['qualifications'] = count($qualifications);
                $d['achievements'] = count($achievements);
                $d['references'] = count($references);
                $d['skills'] = count($skills);
                $d['languages'] = count($languages);
                $this->db->insert('resumes', $d);
                $resume_id = $this->db->insert_id();

                //Inserting experiences
                foreach ($experiences as $e) {
                    $e['resume_id'] = $resume_id;
                    $e['updated_at'] = date('Y-m-d G:i:s');
                    $e['created_at'] = date('Y-m-d G:i:s');
                    $this->db->insert('resume_experiences', $e);
                }

                //Inserting qualifications
                foreach ($qualifications as $q) {
                    $q['resume_id'] = $resume_id;
                    $q['updated_at'] = date('Y-m-d G:i:s');
                    $q['created_at'] = date('Y-m-d G:i:s');
                    $this->db->insert('resume_qualifications', $q);
                }

                //Inserting achievements
                foreach ($achievements as $a) {
                    $a['resume_id'] = $resume_id;
                    $a['updated_at'] = date('Y-m-d G:i:s');
                    $a['created_at'] = date('Y-m-d G:i:s');
                    $this->db->insert('resume_achievements', $a);
                }

                //Inserting references
                foreach ($references as $r) {
                    $r['resume_id'] = $resume_id;
                    $r['updated_at'] = date('Y-m-d G:i:s');
                    $r['created_at'] = date('Y-m-d G:i:s');
                    $this->db->insert('resume_references', $r);
                }

                //Inserting skills
                foreach ($skills as $l) {
                    $l['resume_id'] = $resume_id;
                    $l['updated_at'] = date('Y-m-d G:i:s');
                    $l['created_at'] = date('Y-m-d G:i:s');
                    $this->db->insert('resume_skills', $l);
                }

                //Inserting languages
                foreach ($languages as $l) {
                    $l['resume_id'] = $resume_id;
                    $l['updated_at'] = date('Y-m-d G:i:s');
                    $l['created_at'] = date('Y-m-d G:i:s');
                    $this->db->insert('resume_languages', $l);
                }

                $job_id = $resume_id <= 12 ? 1 : 3;
                $this->importJobBoardData($d['candidate_id'], $job_id, $resume_id);
            }
        }
    }

    public function importJobBoardData($candidate_id, $job_id, $resume_id)
    {
        //Creating a job application entry
        $ja['job_id'] = $job_id;
        $ja['candidate_id'] = $candidate_id;
        $ja['resume_id'] = $resume_id;
        $this->db->insert('job_applications', $ja);
        $ja_id = $this->db->insert_id();

        //Creating a job trait answers entry
        $jts = $this->AdminTraitModel->getJobTraits($job_id);
        $traits_result = array();
        foreach ($jts as $value) {
            $rating =  rand(1,5);
            $traits_result[] = $rating;
            $jt['job_trait_id'] = $value['job_trait_id'];
            $jt['job_trait_title'] = $value['title'];
            $jt['candidate_id'] = $candidate_id;
            $jt['job_application_id'] = $ja_id;
            $jt['rating'] = $rating;
            $this->db->insert('job_trait_answers', $jt);
        }

        //Creating first candidates quizes entries
        $quiz_id = $job_id == 1 ? 2 : 1;
        $quiz_data = $this->AdminQuizModel->getCompleteQuiz($quiz_id);
        $cq['candidate_id'] = $candidate_id;
        $cq['job_id'] = $job_id;
        $cq['quiz_title'] = $quiz_data['quiz']['title'];
        $cq['total_questions'] = count($quiz_data['questions']);
        $cq['allowed_time'] = $quiz_data['quiz']['allowed_time'];
        $cq['correct_answers'] = rand(1,count($quiz_data['questions']));
        $cq['started_at'] = '2019-01-01 00:00:00';
        $cq['attempt'] = 15;
        $cq['quiz_data'] = json_encode($quiz_data);
        $this->db->insert('candidate_quizes', $cq);

        //Creating second candidates quizes entries
        $quiz_data = $this->AdminQuizModel->getCompleteQuiz(3);
        $cq['candidate_id'] = $candidate_id;
        $cq['job_id'] = $job_id;
        $cq['quiz_title'] = $quiz_data['quiz']['title'];
        $cq['total_questions'] = count($quiz_data['questions']);
        $cq['allowed_time'] = $quiz_data['quiz']['allowed_time'];
        $cq['correct_answers'] = rand(1,15);
        $cq['started_at'] = '2019-01-01 00:00:00';
        $cq['attempt'] = 15;
        $cq['quiz_data'] = json_encode($quiz_data);
        $this->db->insert('candidate_quizes', $cq);

        //Creating candidate interview entry
        $interview_data = $this->AdminInterviewModel->getCompleteInterview(3);
        $ci['candidate_id'] = $candidate_id;
        $ci['job_id'] = $job_id;
        $ci['user_id'] = rand(2,10);
        $ci['interview_title'] = $interview_data['interview']['title'];
        $ci['total_questions'] = count($interview_data['questions']);
        $ci['overall_rating'] = rand(1,250);
        $ci['status'] = 1;
        $ci['created_at'] = date('Y-m-d G:i:s');
        $ci['interview_data'] = json_encode($interview_data);
        $this->db->insert('candidate_interviews', $ci);

        //Updating overall results
        $array = array('candidate_id' => $candidate_id, 'job_id' => $job_id);
        $this->AdminJobBoardModel->updateTraitResultInJobApplication($traits_result, $array);                
        $this->AdminJobBoardModel->updateQuizResultInJobApplication($array);
        $this->AdminJobBoardModel->updateInterviewResultInJobApplication($array);                
        $this->AdminJobBoardModel->updateOverallResultInJobApplication($array);

    }

    public function importCompaniesData()
    {
        $data = array(
            array(
                'title' => 'ABC Inc.',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'XYZ Enterprises',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
        );
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('companies');
            if ($result->num_rows() <= 0) {
                $this->db->insert('companies', $d);
                $id = $this->db->insert_id();
            }
        }
    }

    public function importTraitsData()
    {
        $data = array(
            array(
                'title' => 'Communication',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Punctuality',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Attention to detail',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Report Writing',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Presentation Skills',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
        );
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('traits');
            if ($result->num_rows() <= 0) {
                $this->db->insert('traits', $d);
                $id = $this->db->insert_id();
            }
        }
    }

    public function importJobsData()
    {
        $ca = $da = date('Y-m-d G:i:s');
        $data = array(
            array(
                'title' => 'Marketing Executive',
                'slug' => 'marketing-executive',
                'description' => getTextFromFile('job.txt'),
                'company_id' => 1,
                'department_id' => 4,
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'quizes' => array(
                    array('quiz_id' => '2', 'created_at' => $ca, 'allowed_time' => 30),
                    array('quiz_id' => '3', 'created_at' => $ca, 'allowed_time' => 30),
                ),
            ),
            array(
                'title' => 'Accounts Manager',
                'slug' => 'accounts-manager',
                'description' => getTextFromFile('job.txt'),
                'company_id' => 1,                
                'department_id' => 2,
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Computer System Analyst',
                'slug' => 'computer-system-analyst',
                'description' => getTextFromFile('job.txt'),
                'company_id' => 1,                
                'department_id' => 6,
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
                'quizes' => array(
                    array('quiz_id' => '1', 'created_at' => $ca, 'allowed_time' => 30),
                    array('quiz_id' => '3', 'created_at' => $ca, 'allowed_time' => 30),
                ),
            ),
            array(
                'title' => 'Network Administrator',
                'slug' => 'network-administrator',
                'description' => getTextFromFile('job.txt'),
                'company_id' => 1,                
                'department_id' => 6,
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Project Manager',
                'slug' => 'project-manager',
                'description' => getTextFromFile('job.txt'),
                'company_id' => 2,                
                'department_id' => 3,
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'HR Business Partner',
                'slug' => 'hr-business-partner',
                'description' => getTextFromFile('job.txt'),
                'company_id' => 2,                
                'department_id' => 5,
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Quality Supervisor',
                'slug' => 'quality-supervisor',
                'description' => getTextFromFile('job.txt'),
                'company_id' => 2,                
                'department_id' => 3,
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Sr. Software Engineer',
                'slug' => 'sr-software-engineer',
                'description' => getTextFromFile('job.txt'),
                'company_id' => 2,                
                'department_id' => 6,
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Support Staff',
                'slug' => 'support-staff',
                'description' => getTextFromFile('job.txt'),
                'company_id' => 1,                
                'department_id' => 3,
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Warehouse Supervisor',
                'slug' => 'warehouse-supervisor',
                'description' => getTextFromFile('job.txt'),
                'company_id' => 2,                
                'department_id' => 3,
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Legal Advisor',
                'slug' => 'legal-advisor',
                'description' => getTextFromFile('job.txt'),
                'company_id' => 2,                
                'department_id' => 3,
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'CTO',
                'slug' => 'cto',
                'description' => getTextFromFile('job.txt'),
                'company_id' => 2,                
                'department_id' => 3,
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
        );
        $ids = array();
        foreach ($data as $d) {
            $quizes = isset($d['quizes']) ? $d['quizes'] : array();
            unset($d['quizes']);
            $this->db->where('title', $d['title']);
            $result = $this->db->get('jobs');
            if ($result->num_rows() <= 0) {
                $this->db->insert('jobs', $d);
                $id = $this->db->insert_id();
                foreach ($quizes as $quiz) {
                    $quiz_data = $this->AdminQuizModel->getCompleteQuiz($quiz['quiz_id']);
                    $quiz['job_id'] = $id;
                    $quiz['total_questions'] = count($quiz_data['questions']);
                    $quiz['allowed_time'] = $quiz['allowed_time'];
                    $quiz['quiz_data'] = json_encode($quiz_data);
                    $quiz['quiz_title'] = $quiz_data['quiz']['title'];
                    $this->db->insert('job_quizes', $quiz);
                }
                $ids[] = $id;
            }
        }
        $this->importJobTraitsData($ids);        
    }

    public function importJobFavoritesData()
    {
        $ca = $da = date('Y-m-d G:i:s');
        $data = array(
            array('job_id' => 5, 'candidate_id' => 1, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 5, 'candidate_id' => 2, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 5, 'candidate_id' => 3, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 5, 'candidate_id' => 4, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 5, 'candidate_id' => 5, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 5, 'candidate_id' => 6, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 6, 'candidate_id' => 3, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 6, 'candidate_id' => 4, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 6, 'candidate_id' => 6, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 6, 'candidate_id' => 7, 'created_at' => date('Y-m-d G:i:s'),),
        );
        $ids = array();
        foreach ($data as $d) {
            $this->db->where('job_id', $d['job_id']);
            $this->db->where('candidate_id', $d['candidate_id']);
            $result = $this->db->get('job_favorites');
            if ($result->num_rows() <= 0) {
                $this->db->insert('job_favorites', $d);
            }
        }
    }

    public function importJobReferredData()
    {
        $ca = $da = date('Y-m-d G:i:s');
        $data = array(
            array('job_id' => 10, 'candidate_id' => 1, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 10, 'candidate_id' => 2, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 10, 'candidate_id' => 3, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 10, 'candidate_id' => 4, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 10, 'candidate_id' => 5, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 10, 'candidate_id' => 6, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 11, 'candidate_id' => 3, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 11, 'candidate_id' => 4, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 11, 'candidate_id' => 6, 'created_at' => date('Y-m-d G:i:s'),),
            array('job_id' => 11, 'candidate_id' => 7, 'created_at' => date('Y-m-d G:i:s'),),
        );
        $ids = array();
        foreach ($data as $d) {
            $this->db->where('job_id', $d['job_id']);
            $this->db->where('candidate_id', $d['candidate_id']);
            $result = $this->db->get('job_referred');
            if ($result->num_rows() <= 0) {
                $this->db->insert('job_referred', $d);
            }
        }
    }

    private function importJobFilters()
    {
        $dates = array('created_at' => date('Y-m-d G:i:s'), 'updated_at' => date('Y-m-d G:i:s'));
        $data = array(
            array(
                'title' => 'Location',
                'order' => 1,
                'type' => 'dropdown',
                'front_home_filter' => 1,
                'status' => 1,
                'values' => array('New Delhi', 'New York', 'Moscow', 'Rome', 'Jakarta', 'Paris', 'Beijing', 'Oslo')
            ),
            array(
                'title' => 'Experience Level',
                'order' => 1,
                'type' => 'radio',
                'front_home_filter' => 1,
                'status' => 1,
                'values' => array('6 Months', '1 Year', '3 Years', '5 Years', 'More than 5 Years')
            ),
            array(
                'title' => 'Job Type',
                'order' => 1,
                'type' => 'radio',
                'front_home_filter' => 1,
                'status' => 1,
                'values' => array('On Site', 'Remote', 'Freelance', 'Full Time'),
            ),
        );
        foreach ($data as $d) {
            $values = $d['values'];
            unset($d['values']);

            //$this->db->where('employer_id', 0);
            $this->db->where('title', $d['title']);
            $result = $this->db->get('job_filters');

            if ($result->num_rows() <= 0) {
                $this->db->insert('job_filters', array_merge($dates, $d));
                $job_filter_id = $this->db->insert_id();
                foreach ($values as $value) {
                    $jfv['title'] = $value;
                    $jfv['job_filter_id'] = $job_filter_id;
                    $this->db->insert('job_filter_values', $jfv);
                }
            }
        }
    }

    public function importBlogCategoriesData()
    {
        $ca = $da = date('Y-m-d G:i:s');
        $data = array(
            array(
                'title' => 'Category 1',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Category 2',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Category 3',
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
        );
        $ids = array();
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('blog_categories');
            if ($result->num_rows() <= 0) {
                $this->db->insert('blog_categories', $d);
            }
        }
    }

    public function importBlogsData()
    {
        $ca = $da = date('Y-m-d G:i:s');
        $data = array(
            array(
                'title' => 'Frequently Asked Questions',
                'description' => getTextFromFile('job.txt'),
                'image' => '01.jpg',
                'blog_category_id' => 1,
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'How to Apply',
                'description' => getTextFromFile('job.txt'),
                'image' => '02.jpg',
                'blog_category_id' => 1,                
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Quiz Timings',
                'description' => getTextFromFile('job.txt'),
                'image' => '03.jpg',
                'blog_category_id' => 2,
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
            array(
                'title' => 'Privacy Policy',
                'description' => getTextFromFile('job.txt'),
                'image' => '04.jpg',
                'blog_category_id' => 3,                
                'status' => 1,
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s'),
            ),
        );
        $ids = array();
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('blogs');
            if ($result->num_rows() <= 0) {
                $this->db->insert('blogs', $d);
            }
        }
    }

    public function importJobTraitsData($job_ids)
    {
        $this->db->from('traits');
        $traits = $this->db->get();
        $traits = objToArr($traits->result());
        foreach ($traits as $d) {
            foreach ($job_ids as $job_id) {
                $this->db->where('title', $d['title']);
                $this->db->where('job_id', $job_id);
                $result = $this->db->get('job_traits');
                if ($result->num_rows() <= 0) {
                    $d2 = array(
                        'job_id' => $job_id, 
                        'trait_id' => $d['trait_id'], 
                        'title' => $d['title'],
                        'created_at' => date('Y-m-d G:i:s'),
                    );
                    $this->db->insert('job_traits', $d2);
                }
            }
        }
    }

    public function importToDos()
    {
        $data = array(
            array('user_id' => '1', 'status' => '1', 'title' => 'Create a Job', 'description' => 'Create a Job',),
            array('user_id' => '1', 'status' => '1', 'title' => 'Add Team Member', 'description' => 'Add Team Member',),
            array('user_id' => '1', 'status' => '1', 'title' => 'Take Interview', 'description' => 'Take Interview',),
            array('user_id' => '1', 'status' => '1', 'title' => 'Edit Quizes', 'description' => 'Edit Quizes',),
            array('user_id' => '1', 'status' => '1', 'title' => 'Make Blog Post', 'description' => 'Make Blog Post',),
            array('user_id' => '1', 'status' => '1', 'title' => 'Create a Job 2', 'description' => 'Create a Job',),
            array('user_id' => '1', 'status' => '1', 'title' => 'Add Team Member 2', 'description' => 'Add Team Member',),
            array('user_id' => '1', 'status' => '1', 'title' => 'Take Interview 2', 'description' => 'Take Interview',),
            array('user_id' => '1', 'status' => '1', 'title' => 'Edit Quizes 2', 'description' => 'Edit Quizes',),
            array('user_id' => '1', 'status' => '1', 'title' => 'Make Blog Post 2', 'description' => 'Make Blog Post',),
        );
        foreach ($data as $d) {
            $this->db->where('title', $d['title']);
            $result = $this->db->get('to_dos');
            if ($result->num_rows() <= 0) {
                $this->db->insert('to_dos', $d);
            }
        }
    }
}