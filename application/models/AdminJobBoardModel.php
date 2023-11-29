<?php

class AdminJobBoardModel extends CI_Model
{
    protected $table = 'jobs';
    protected $key = 'job_id';

    public function getJobs()
    {
        //Setting session for every parameter of the request
        $this->setSessionValues();

        //First getting total records
        $total = $this->getTotalJobs();
        
        //Setting filters, search and pagination via posted session variables
        $search = $this->getSessionValues('jobs_search');
        $company_id = $this->getSessionValues('jobs_company_id');
        $department_id = $this->getSessionValues('jobs_department_id');
        $status = $this->getSessionValues('jobs_status');
        $page = $this->getSessionValues('jobs_page', 1);
        $per_page = $this->getSessionValues('jobs_per_page', 10);

        $per_page = $per_page < $total ? $per_page : $total;
        $limit = $per_page;
        $offset = ($page == 1 ? 0 : ($page-1)) * $per_page;
        $offset = $offset < 0 ? 0 : $offset;

        $this->db->select('
            jobs.*,
            companies.title as company,
            departments.title as department,
            COUNT(DISTINCT('.CF_DB_PREFIX.'job_traits.trait_id)) as traits_count,
            COUNT(DISTINCT('.CF_DB_PREFIX.'job_quizes.quiz_id)) as quizes_count,
            COUNT(DISTINCT('.CF_DB_PREFIX.'job_applications.job_application_id)) as hired_count
        ');
        if ($search) {
            $this->db->group_start()->like('jobs.title', $search)->group_end();
        }        
        if ($company_id) {
            $this->db->where('jobs.company_id', $company_id);
        }
        if ($department_id) {
            $this->db->where('jobs.department_id', $department_id);
        }
        if ($status) {
            $this->db->where('jobs.status', $status);
        } else if ($status == 'zero') {
            $this->db->where('jobs.status', 0);
        }
        $this->db->join('companies', 'companies.company_id = jobs.company_id', 'left');
        $this->db->join('departments', 'departments.department_id = jobs.department_id', 'left');
        $this->db->join('job_traits', 'job_traits.job_id = jobs.job_id', 'left');
        $this->db->join('job_quizes', 'job_quizes.job_id = jobs.job_id', 'left');
        $this->db->join('job_applications', 'job_applications.job_id = jobs.job_id AND job_applications.status = "hired"', 'left');
        $this->db->from($this->table);
        $this->db->group_by('jobs.job_id');
        $this->db->order_by('jobs.created_at', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        $records = objToArr($query->result());

        //Making pagination for display
        $total_pages = $total != 0 ? ceil($total/$per_page) : 0;
        $pagination = ($offset == 0 ? 1 : ($offset+1));
        $pagination .= ' - ';
        $pagination .= $total_pages == $page ? $total : ($limit*$page);
        $pagination .= ' of ';
        $pagination .= $total;

        //Returning final results
        return array(
            'records' => $records,
            'total' =>  $total,
            'total_pages' => $total_pages,
            'pagination' => $pagination
        );
    }

    public function getTotalJobs()
    {
        $search = $this->getSessionValues('jobs_search');
        $company_id = $this->getSessionValues('jobs_company_id');
        $department_id = $this->getSessionValues('jobs_department_id');
        $status = $this->getSessionValues('jobs_status');

        if ($search) {
            $this->db->group_start()->like('jobs.title', $search)->group_end();
        }        
        if ($company_id) {
            $this->db->where('jobs.company_id', $company_id);
        }
        if ($department_id) {
            $this->db->where('jobs.department_id', $department_id);
        }
        if ($status) {
            $this->db->where('jobs.status', $status);
        } else if ($status == 'zero') {
            $this->db->where('jobs.status', 0);
        }
        $this->db->join('companies', 'companies.company_id = jobs.company_id', 'left');
        $this->db->join('departments', 'departments.department_id = jobs.department_id', 'left');
        $this->db->from($this->table);
        $this->db->group_by('jobs.job_id');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getCandidates($job_id)
    {
        //Setting session for every parameter of the request
        $this->setSessionValues();

        //First getting total records
        $total = $this->getTotalCandidatesWithFilters($job_id);
        
        //Search and filters
        $search = $this->getSessionValues('candidates_search');
        $min_experience = $this->getSessionValues('candidates_min_experience');
        $max_experience = $this->getSessionValues('candidates_max_experience');
        $min_overall = $this->getSessionValues('candidates_min_overall');
        $max_overall = $this->getSessionValues('candidates_max_overall');
        $min_interview = $this->getSessionValues('candidates_min_interview');
        $max_interview = $this->getSessionValues('candidates_max_interview');
        $min_quiz = $this->getSessionValues('candidates_min_quiz');
        $max_quiz = $this->getSessionValues('candidates_max_quiz');
        $min_self = $this->getSessionValues('candidates_min_self');
        $max_self = $this->getSessionValues('candidates_max_self');
        $status = $this->getSessionValues('candidates_status');

        $gender = $this->getSessionValues('candidates_gender');
        $min_age = $this->getSessionValues('candidates_min_age');
        $max_age = $this->getSessionValues('candidates_max_age');
        $city = $this->getSessionValues('candidates_city');
        $state = $this->getSessionValues('candidates_state');
        $country = $this->getSessionValues('candidates_country');
        $address = $this->getSessionValues('candidates_address');        

        //Pagination and sorting
        $sort = $this->getSessionValues('candidates_sort', 'overall');
        $page = $this->getSessionValues('candidates_page', 1);
        $per_page = $this->getSessionValues('candidates_per_page', 10);

        //Calculating limit and offset
        $limit = $per_page;
        $per_page = $per_page < $total ? $per_page : $total;
        $offset = ($page == 1 ? 0 : ($page-1)) * $per_page;
        $offset = $offset < 0 ? 0 : $offset;

        $this->db->select('
            job_applications.*,
            job_applications.resume_id,
            resumes.designation,
            resumes.experience,
            resumes.experiences,
            resumes.qualifications,
            resumes.languages,
            resumes.achievements,
            resumes.references,
            resumes.type as resume_type,
            resumes.file,
            candidates.image,
            candidates.first_name,
            candidates.last_name,
            GROUP_CONCAT(DISTINCT(CONCAT('.CF_DB_PREFIX.'job_trait_answers.job_trait_answer_id,"-",'.CF_DB_PREFIX.'job_trait_answers.rating)) SEPARATOR "-=-++-=-") AS trait_ratings,
            GROUP_CONCAT(DISTINCT(CONCAT('.CF_DB_PREFIX.'job_trait_answers.job_trait_id,"*-*",'.CF_DB_PREFIX.'job_trait_answers.job_trait_title)) SEPARATOR "-=-++-=-") AS trait_titles,
            GROUP_CONCAT(DISTINCT(CONCAT('.CF_DB_PREFIX.'candidate_quizes.candidate_quiz_id, "-", '.CF_DB_PREFIX.'candidate_quizes.total_questions, "-", '.CF_DB_PREFIX.'candidate_quizes.correct_answers)) SEPARATOR "-=-++-=-") AS quizes,
            GROUP_CONCAT(DISTINCT(CONCAT('.CF_DB_PREFIX.'candidate_quizes.candidate_quiz_id, "*-*", '.CF_DB_PREFIX.'candidate_quizes.quiz_title)) SEPARATOR "-=-++-=-") AS quizes_titles,
            GROUP_CONCAT(DISTINCT(CONCAT('.CF_DB_PREFIX.'candidate_interviews.candidate_interview_id, "-", '.CF_DB_PREFIX.'candidate_interviews.total_questions, "-", '.CF_DB_PREFIX.'candidate_interviews.overall_rating)) SEPARATOR "-=-++-=-") AS interviews,
            GROUP_CONCAT(DISTINCT(CONCAT('.CF_DB_PREFIX.'candidate_interviews.candidate_interview_id, "*-*", '.CF_DB_PREFIX.'candidate_interviews.interview_title)) SEPARATOR "-=-++-=-") AS interviews_titles
        ');

        //Applying fiters and search
        if ($search) {
            $this->db->group_start()->like('candidates.first_name', $search)
            ->or_like('candidates.last_name', $search)->group_end();
        }
        if($min_experience) {
            $this->db->where('resumes.experience >=', $min_experience);
        }
        if($max_experience) {
            $this->db->where('resumes.experience <=', $max_experience);
        }
        if($min_overall) {
            $this->db->where('job_applications.overall_result >=', $min_overall);
        }
        if($max_overall) {
            $this->db->where('job_applications.overall_result <=', $max_overall);
        }
        if($min_interview) {
            $this->db->where('job_applications.interviews_result >=', $min_interview);
        }
        if($max_interview) {
            $this->db->where('job_applications.interviews_result <=', $max_interview);
        }
        if($min_quiz) {
            $this->db->where('job_applications.quizes_result >=', $min_quiz);
        }
        if($max_quiz) {
            $this->db->where('job_applications.quizes_result <=', $max_quiz);
        }
        if($min_self) {
            $this->db->where('job_applications.traits_result >=', $min_self);
        }
        if($max_self) {
            $this->db->where('job_applications.traits_result <=', $max_self);
        }
        if($status) {
            $this->db->where('job_applications.status', $status);
        }
        if ($gender) {
            $this->db->where('candidates.gender', $gender);
        }
        if ($min_age) {
            $this->db->where('DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), cf_candidates.dob)), "%Y")+0 >= ', $min_age);
        }
        if ($max_age) {
            $this->db->where('DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), cf_candidates.dob)), "%Y")+0 <= ', $max_age);
        }
        if ($city) {
            $this->db->where('candidates.city', $city);
        }
        if ($state) {
            $this->db->where('candidates.state', $state);
        }
        if ($country) {
            $this->db->where('candidates.country', $country);
        }
        if ($address) {
            $this->db->where('candidates.address', $address);
        }

        $this->db->where('job_applications.job_id', $job_id);
        $this->db->join('resumes', 'resumes.resume_id = job_applications.resume_id', 'left');
        $this->db->join('candidates', 'candidates.candidate_id = job_applications.candidate_id', 'left');
        $this->db->join('job_trait_answers', 'job_trait_answers.job_application_id = job_applications.job_application_id', 'left');
        $this->db->join('job_traits', 'job_traits.job_trait_id = job_trait_answers.job_trait_id', 'left');
        $this->db->join(
            'candidate_quizes', 
            'candidate_quizes.job_id = job_applications.job_id AND candidate_quizes.candidate_id = job_applications.candidate_id',
            'left'
        );        
        $this->db->join(
            'candidate_interviews', 
            'candidate_interviews.job_id = job_applications.job_id AND candidate_interviews.candidate_id = job_applications.candidate_id',
            'left'
        );        
        $this->db->from('job_applications');
        $this->db->group_by('job_applications.job_application_id');

        //Setting order by as per preference
        if ($sort == 'applied') {
            $this->db->order_by('job_applications.created_at', 'DESC');
        } elseif ($sort == 'overall') {
            $this->db->order_by('job_applications.overall_result', 'DESC');
        } elseif ($sort == 'quiz') {
            $this->db->order_by('job_applications.quizes_result', 'DESC');
        } elseif ($sort == 'self') {
            $this->db->order_by('job_applications.traits_result', 'DESC');
        } elseif ($sort == 'interview') {
            $this->db->order_by('job_applications.interviews_result', 'DESC');
        } elseif ($sort == 'experience') {
            $this->db->order_by('resumes.experience', 'DESC');
        }
        
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        $records = $this->sorted($query->result());

        //Making pagination for display
        $total_pages = $total != 0 ? ceil($total/$per_page) : 0;
        $pagination = ($offset == 0 ? 1 : ($offset+1));
        $pagination .= ' - ';
        $pagination .= $total_pages == $page ? $total : ($limit*$page);
        $pagination .= ' of ';
        $pagination .= $total;

        //Returning final results
        return array(
            'records' => $records,
            'total' =>  $total,
            'candidates_all' => $this->getTotalCandidates($job_id),
            'total_pages' => $total_pages,
            'pagination' => $pagination
        );
    }

    public function traitsResult()
    {
        $this->db->select('
            candidates.candidate_id,
            candidates.first_name,
            candidates.last_name,
            GROUP_CONCAT(DISTINCT(CONCAT('.CF_DB_PREFIX.'job_trait_answers.job_trait_answer_id,"-",'.CF_DB_PREFIX.'job_trait_answers.rating)) SEPARATOR "-=-++-=-") AS trait_ratings,
            GROUP_CONCAT(DISTINCT(CONCAT('.CF_DB_PREFIX.'job_trait_answers.job_trait_id,"*-*",'.CF_DB_PREFIX.'job_trait_answers.job_trait_title)) SEPARATOR "-=-++-=-") AS trait_titles
        ');

        $this->db->where('job_applications.job_id', $this->xssCleanInput('job'));
        $this->db->where_in('job_applications.candidate_id', explode(',', $this->xssCleanInput('ids')));
        $this->db->join('candidates', 'candidates.candidate_id = job_applications.candidate_id', 'left');
        $this->db->join('job_trait_answers', 'job_trait_answers.job_application_id = job_applications.job_application_id', 'left');
        $this->db->join('job_traits', 'job_traits.job_trait_id = job_trait_answers.job_trait_id', 'left');
        $this->db->join(
            'candidate_quizes', 
            'candidate_quizes.job_id = job_applications.job_id AND candidate_quizes.candidate_id = job_applications.candidate_id',
            'left'
        );        
        $this->db->from('job_applications');
        $this->db->group_by('job_applications.job_application_id');        
        $query = $this->db->get();
        return $this->sorted($query->result());
    }

    public function quizesResult()
    {
        $this->db->select('
            job_applications.quizes_result,
            candidates.candidate_id,
            candidates.first_name,
            candidates.last_name,
            candidate_quizes.quiz_title,
            candidate_quizes.quiz_data,
            candidate_quizes.answers_data,
            candidate_quizes.total_questions,
            candidate_quizes.correct_answers
        ');
        $this->db->where('job_applications.job_id', $this->xssCleanInput('job'));
        $this->db->where_in('job_applications.candidate_id', explode(',', $this->xssCleanInput('ids')));
        $this->db->join('candidates', 'candidates.candidate_id = job_applications.candidate_id', 'left');
        $this->db->join(
            'candidate_quizes', 
            'candidate_quizes.candidate_id = job_applications.candidate_id AND 
             candidate_quizes.job_id = job_applications.job_id', 
            'left'
        );
        $this->db->from('job_applications');
        $query = $this->db->get();
        $result = objToArr($query->result());

        //Arranging by candidate
        $final = array();
        foreach ($result as $value) {
            $final[$value['candidate_id']][] = $value;
        }
        return $final;
    }

    public function interviewsResult()
    {
        $this->db->select('
            job_applications.interviews_result,
            candidates.candidate_id,
            candidates.first_name,
            candidates.last_name,
            candidate_interviews.interview_title,
            candidate_interviews.interview_data,
            candidate_interviews.answers_data,
            candidate_interviews.total_questions,
            candidate_interviews.overall_rating
        ');
        $this->db->where('job_applications.job_id', $this->xssCleanInput('job'));
        $this->db->where_in('job_applications.candidate_id', explode(',', $this->xssCleanInput('ids')));
        $this->db->join('candidates', 'candidates.candidate_id = job_applications.candidate_id', 'left');
        $this->db->join(
            'candidate_interviews', 
            'candidate_interviews.candidate_id = job_applications.candidate_id AND candidate_interviews.job_id = job_applications.job_id', 
            'left'
        );
        $this->db->from('job_applications');
        $query = $this->db->get();
        $result = objToArr($query->result());

        //Arranging by candidate
        $final = array();
        foreach ($result as $value) {
            $final[$value['candidate_id']][] = $value;
        }
        return $final;
    }

    public function overallResult()
    {
        $this->db->select('
            candidates.candidate_id,
            candidates.first_name,
            candidates.last_name,
            job_applications.created_at as applied_on,
            job_applications.status,
            resumes.designation,
            resumes.objective,
            resumes.experience,
            resumes.experiences,
            resumes.qualifications,
            resumes.languages,
            resumes.achievements,
            resumes.references,
            job_applications.traits_result as self_assesment,
            job_applications.quizes_result,
            job_applications.interviews_result,
            job_applications.overall_result,
        ');
        $this->db->where('job_applications.job_id', $this->xssCleanInput('job'));
        $this->db->where_in('job_applications.candidate_id', explode(',', $this->xssCleanInput('ids')));
        $this->db->join('resumes', 'resumes.resume_id = job_applications.resume_id', 'left');
        $this->db->join('candidates', 'candidates.candidate_id = job_applications.candidate_id', 'left');     
        $this->db->from('job_applications');
        $this->db->group_by('job_applications.job_application_id');
        $this->db->order_by('resumes.experience', 'DESC');
        $query = $this->db->get();
        return objToArr($query->result());
    }

    public function getTotalCandidatesWithFilters($job_id)
    {
        //Search and filters
        $search = $this->getSessionValues('candidates_search');
        $min_experience = $this->getSessionValues('candidates_min_experience');
        $max_experience = $this->getSessionValues('candidates_max_experience');
        $min_overall = $this->getSessionValues('candidates_min_overall');
        $max_overall = $this->getSessionValues('candidates_max_overall');
        $min_interview = $this->getSessionValues('candidates_min_interview');
        $max_interview = $this->getSessionValues('candidates_max_interview');
        $min_quiz = $this->getSessionValues('candidates_min_quiz');
        $max_quiz = $this->getSessionValues('candidates_max_quiz');
        $min_self = $this->getSessionValues('candidates_min_self');
        $max_self = $this->getSessionValues('candidates_max_self');
        $status = $this->getSessionValues('candidates_status');

        $gender = $this->getSessionValues('candidates_gender');
        $min_age = $this->getSessionValues('candidates_min_age');
        $max_age = $this->getSessionValues('candidates_max_age');
        $city = $this->getSessionValues('candidates_city');
        $state = $this->getSessionValues('candidates_state');
        $country = $this->getSessionValues('candidates_country');
        $address = $this->getSessionValues('candidates_address');        

        //Applying fiters and search
        if ($search) {
            $this->db->group_start()->like('candidates.first_name', $search)
            ->or_like('candidates.last_name', $search)->group_end();
        }
        if($min_experience) {
            $this->db->where('resumes.experience >=', $min_experience);
        }
        if($max_experience) {
            $this->db->where('resumes.experience <=', $max_experience);
        }
        if($min_overall) {
            $this->db->where('job_applications.overall_result >=', $min_overall);
        }
        if($max_overall) {
            $this->db->where('job_applications.overall_result <=', $max_overall);
        }
        if($min_interview) {
            $this->db->where('job_applications.interviews_result >=', $min_interview);
        }
        if($max_interview) {
            $this->db->where('job_applications.interviews_result <=', $max_interview);
        }
        if($min_quiz) {
            $this->db->where('job_applications.quizes_result >=', $min_quiz);
        }
        if($max_quiz) {
            $this->db->where('job_applications.quizes_result <=', $max_quiz);
        }
        if($min_self) {
            $this->db->where('job_applications.traits_result >=', $min_self);
        }
        if($max_self) {
            $this->db->where('job_applications.traits_result <=', $max_self);
        }
        if($status) {
            $this->db->where('job_applications.status', $status);
        }
        if ($gender) {
            $this->db->where('candidates.gender', $gender);
        }
        if ($min_age) {
            $this->db->where('DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), cf_candidates.dob)), "%Y")+0 >= ', $min_age);
        }
        if ($max_age) {
            $this->db->where('DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), cf_candidates.dob)), "%Y")+0 <= ', $max_age);
        }
        if ($city) {
            $this->db->where('candidates.city', $city);
        }
        if ($state) {
            $this->db->where('candidates.state', $state);
        }
        if ($country) {
            $this->db->where('candidates.country', $country);
        }
        if ($address) {
            $this->db->where('candidates.address', $address);
        }        
        $this->db->where('job_applications.job_id', $job_id);
        $this->db->join('candidates', 'candidates.candidate_id = job_applications.candidate_id', 'left');
        $this->db->join('resumes', 'resumes.resume_id = job_applications.resume_id', 'left');
        $this->db->from('job_applications');
        $this->db->group_by('job_applications.job_application_id');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getTotalCandidates($job_id)
    {
        $this->db->where('job_applications.job_id', $job_id);
        $this->db->from('job_applications');
        $this->db->group_by('job_applications.job_application_id');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function assignToCandidates()
    {
        $data = $this->xssCleanInput();
        $candidates = json_decode($data['candidates']);

        if ($data['type'] == 'quiz') {
            $qdata = $this->AdminQuizModel->getCompleteQuiz($data['quiz_id']);
            foreach ($candidates as $candidate) {
                $candidate_quiz['candidate_id'] = $detail['candidate_id'] = $candidate;
                $candidate_quiz['job_id'] = $detail['job_id'] =$data['job_id'];
                $candidate_quiz['job_quiz_id'] = '';
                $candidate_quiz['quiz_title'] = $qdata['quiz']['title'];
                $candidate_quiz['quiz_data'] = json_encode($qdata);
                $candidate_quiz['total_questions'] = count($qdata['questions']);
                $candidate_quiz['allowed_time'] = $qdata['quiz']['allowed_time'];
                $candidate_quiz['correct_answers'] = 0;
                $candidate_quiz['attempt'] = 0;
                $candidate_quiz['created_at'] = date('Y-m-d G:i:s');
                $this->db->insert('candidate_quizes', $candidate_quiz);
                $this->updateQuizResultInJobApplication($detail);
                $this->updateOverallResultInJobApplication($detail);
            }
        } else {
            $idata = $this->AdminInterviewModel->getCompleteInterview($data['interview_id']);
            foreach ($candidates as $candidate) {
                $candidate_interview['candidate_id'] = $detail['candidate_id'] = $candidate;
                $candidate_interview['job_id'] = $detail['job_id'] =$data['job_id'];
                $candidate_interview['interview_title'] = $idata['interview']['title'];
                $candidate_interview['interview_data'] = json_encode($idata);
                $candidate_interview['interview_time'] = $data['interview_time'];
                $candidate_interview['description'] = $data['description'];
                $candidate_interview['total_questions'] = count($idata['questions']);
                $candidate_interview['overall_rating'] = 0;
                $candidate_interview['created_at'] = date('Y-m-d G:i:s');
                $candidate_interview['user_id'] = $data['user_id'];
                $this->db->insert('candidate_interviews', $candidate_interview);
                $this->updateInterviewResultInJobApplication($detail);
                $this->updateOverallResultInJobApplication($detail);
            }
        }
    }

    public function updateCandidateStatus()
    {
        $data = $this->xssCleanInput();
        $candidates = json_decode($data['data']);
        $data = objToArr(json_decode($this->xssCleanInput('data')));
        $action = $data['action'];
        $ids = $data['ids'];
        $job = $data['job'];

        foreach ($ids as $id) {
            $this->db->where('job_applications.job_id', $job);
            $this->db->where('job_applications.candidate_id', $id);
            $this->db->update('job_applications', array('status' => $action));
        }
    }

    public function updateOverallResult()
    {
        $data = $this->xssCleanInput();
        $overall_result = $data['overall_result'] ? $data['overall_result'] : 0;
        $this->db->where('job_applications.job_application_id', $data['job_app_id']);
        $this->db->update('job_applications', array('overall_result' => $overall_result));
    }

    public function deleteCandidateApplication()
    {
        $data = $this->xssCleanInput();
        $data = objToArr(json_decode($this->xssCleanInput('data')));
        $ids = $data['ids'];
        $job = $data['job'];

        foreach ($ids as $id) {
            $this->db->delete('job_applications', array('candidate_id' => $id, 'job_id' => $job));
            $this->db->delete('candidate_quizes', array('candidate_id' => $id, 'job_id' => $job));
            $this->db->delete('candidate_interviews', array('candidate_id' => $id, 'job_id' => $job));
        }
    }

    public function setSessionValues()
    {
        $data = $this->xssCleanInput();
        foreach ($data as $name => $value) {
            $this->session->set_userdata($name, $value);
        }
    }

    public function getSessionValues($name, $default = '')
    {
        return ($this->session->userdata($name) ? $this->session->userdata($name) : $default);
    }

    public function updateInterviewResultInJobApplication($data)
    {
        $this->db->select('
            ROUND((SUM('.CF_DB_PREFIX.'candidate_interviews.overall_rating)/(SUM('.CF_DB_PREFIX.'candidate_interviews.total_questions)*10))*100) as percent
        ');
        $this->db->where('candidate_interviews.candidate_id', $data['candidate_id']);
        $this->db->where('candidate_interviews.job_id', $data['job_id']);
        $result = $this->db->get('candidate_interviews');
        $result = ($result->num_rows() == 1) ? objToArr($result->row(0)) : array();
        $percent = isset($result['percent']) ? $result['percent'] : 0;

        $this->db->where('job_applications.candidate_id', $data['candidate_id']);
        $this->db->where('job_applications.job_id', $data['job_id']);
        $this->db->update('job_applications', array('interviews_result' => $percent));
    }

    public function updateQuizResultInJobApplication($data)
    {
        $this->db->select('
            ROUND((SUM('.CF_DB_PREFIX.'candidate_quizes.correct_answers)/SUM('.CF_DB_PREFIX.'candidate_quizes.total_questions))*100) as percent
        ');
        $this->db->where('candidate_quizes.candidate_id', $data['candidate_id']);
        $this->db->where('candidate_quizes.job_id', $data['job_id']);
        $result = $this->db->get('candidate_quizes');
        $result = ($result->num_rows() == 1) ? objToArr($result->row(0)) : array();
        $percent = isset($result['percent']) ? $result['percent'] : 0;
        $this->db->where('job_applications.candidate_id', $data['candidate_id']);
        $this->db->where('job_applications.job_id', $data['job_id']);
        $this->db->update('job_applications', array('quizes_result' => $percent));
    }

    public function updateTraitResultInJobApplication($traits_result, $data)
    {
        //Third inserting overall trait results to job_applications table //For Job Board results
        $total = array_sum($traits_result);
        $div = count($traits_result)*5;
        $traits_result = ceil(($total/$div)*100);
        $this->db->where('job_applications.candidate_id', $data['candidate_id']);
        $this->db->where('job_applications.job_id', $data['job_id']);
        $this->db->update('job_applications', array('traits_result' => $traits_result));
    }

    public function updateOverallResultInJobApplication($data)
    {
        $this->db->set(
            'overall_result',
            'ROUND(('.CF_DB_PREFIX.'job_applications.traits_result+'.CF_DB_PREFIX.'job_applications.quizes_result+'.CF_DB_PREFIX.'job_applications.interviews_result)/3)',
            false
        );
        $this->db->where('job_applications.candidate_id', $data['candidate_id']);
        $this->db->where('job_applications.job_id', $data['job_id']);
        $this->db->update('job_applications');
    }

    public function sorted($candidates)
    {
        $return = array();
        $candidates = objToArr($candidates);
        foreach ($candidates as $candidate) {
            //Refreshing all
            $trait_ratings = array();
            $trait_titles = array();
            $quizes = array();
            $interviews = array();
            $quiz_titles = array();
            $interview_titles = array();
            //For Traits
            if (isset($candidate['trait_ratings'])) {
                $trait_ratings = explode('-=-++-=-', $candidate['trait_ratings']);
                $trait_titles = explode('-=-++-=-', $candidate['trait_titles']);
            }
            if (isset($trait_ratings[0])) {
                $ids = array();
                $titles = array();
                $ratings = array();
                foreach ($trait_ratings as $value) {
                    $exploded = explode('-', $value);
                    $ratings[] = $exploded[1];
                }
                foreach ($trait_titles as $value) {
                    $exploded = explode('*-*', $value);
                    $titles[] = $exploded[1];
                }
                $candidate['traits'] = arrangeSections(array('title' => $titles, 'rating' => $ratings));
                $candidate['trait_overall'] = array_sum($ratings);
            } else {
                $candidate['traits'] = array();
            }
            //For Quizes
            if (isset($candidate['quizes'])) {
                $quizes = explode('-=-++-=-', $candidate['quizes']);
                $quiz_titles = explode('-=-++-=-', $candidate['quizes_titles']);
            }
            if (isset($quizes[0])) {
                $ids = array();
                $questions = array();
                $corrects = array();
                $titles = array();
                foreach ($quizes as $value) {
                    $exploded = explode('-', $value);
                    $questions[] = $exploded[1];
                    $corrects[] = $exploded[2];
                }
                foreach ($quiz_titles as $value) {
                    $exploded = explode('*-*', $value);
                    $ids[] = $exploded[0];
                    $titles[] = $exploded[1];
                }
                $candidate['quizes'] = arrangeSections(
                    array('questions' => $questions, 'corrects' => $corrects, 'title' => $titles, 'id' => $ids)
                );
            } else {
                $candidate['quizes'] = array();
            }
            //For Interviews
            if (isset($candidate['interviews'])) {
                $interviews = explode('-=-++-=-', $candidate['interviews']);
                $interview_titles = explode('-=-++-=-', $candidate['interviews_titles']);
            }
            if (isset($interviews[0])) {
                $ids = array();
                $questions = array();
                $ratings = array();
                $titles = array();
                foreach ($interviews as $value) {
                    $exploded = explode('-', $value);
                    $questions[] = $exploded[1];
                    $ratings[] = $exploded[2];
                }
                foreach ($interview_titles as $value) {
                    $exploded = explode('*-*', $value);
                    $ids[] = $exploded[0];
                    $titles[] = $exploded[1];
                }
                $candidate['interviews'] = arrangeSections(
                    array('questions' => $questions, 'ratings' => $ratings, 'title' => $titles, 'id' => $ids)
                );
            } else {
                $candidate['interviews'] = array();
            }
            unset($candidate['trait_ratings'],$candidate['trait_titles'],$candidate['quizes_titles'],$candidate['interviews_titles']);
            $return[] = $candidate;
        }
        return $return;
    }

    public function getJobApplicationsCount($status = '')
    {
        if ($status) {
        $this->db->where('status', $status);
        }
        $query = $this->db->get('job_applications');
        return $query->num_rows();
    }    

}