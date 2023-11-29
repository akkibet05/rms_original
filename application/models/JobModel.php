<?php

class JobModel extends CI_Model
{
    protected $table = 'jobs';
    protected $key = 'job_id';
    protected $candidate_id;

    public function __construct()
    {
        parent::__construct();
        @$this->candidate_id = candidateSession();        
    }

    public function getJob($slug, $byId = false)
    {       
        if ($byId) {
            $this->db->where('jobs.job_id', decode($slug));
        } else {
            $this->db->where('jobs.slug', $slug);
        }
        $this->db->select('
            jobs.*,
            departments.title as department,
            COUNT(DISTINCT('.CF_DB_PREFIX.'job_quizes.job_quiz_id)) as quizes_count,
            COUNT(DISTINCT('.CF_DB_PREFIX.'job_traits.job_trait_id)) as traits_count,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_traits.trait_id)) as traits,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_custom_fields.label) SEPARATOR "-=-++-=-") as field_labels,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_custom_fields.value) SEPARATOR "-=-++-=-") as field_values,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_traits.job_trait_id) SEPARATOR "-=-++-=-") as job_trait_ids,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_traits.title) SEPARATOR "-=-++-=-") as trait_titles,
            GROUP_CONCAT(DISTINCT(CONCAT('.CF_DB_PREFIX.'job_filter_values.job_filter_value_id, "(--)", '.CF_DB_PREFIX.'job_filter_values.title)) SEPARATOR "-=-++-=-") as job_filter_values,
            GROUP_CONCAT(DISTINCT(CONCAT('.CF_DB_PREFIX.'job_filters.job_filter_id, "(--)", '.CF_DB_PREFIX.'job_filters.title)) SEPARATOR "-=-++-=-") as job_filter_titles,
            GROUP_CONCAT(DISTINCT(CONCAT('.CF_DB_PREFIX.'job_filter_value_assignments.job_filter_id, "-", '.CF_DB_PREFIX.'job_filter_value_assignments.job_filter_value_id))) AS combined 
        ');
        $this->db->join('job_filter_value_assignments', 'job_filter_value_assignments.job_id = jobs.job_id', 'left');
        $this->db->join('job_filter_values', 'job_filter_values.job_filter_value_id = job_filter_value_assignments.job_filter_value_id', 'left');
        $this->db->join('job_filters', 'job_filters.job_filter_id = job_filter_values.job_filter_id', 'left');        
        $this->db->join('departments', 'departments.department_id = jobs.department_id', 'left');
        $this->db->join('job_traits', 'job_traits.job_id = jobs.job_id', 'left');
        $this->db->join('job_custom_fields', 'job_custom_fields.job_id = jobs.job_id', 'left');
        $this->db->join('job_quizes', 'job_quizes.job_id = jobs.job_id', 'left');
        $this->db->group_by('jobs.job_id');
        $result = $this->db->get('jobs');
        $result = ($result->num_rows() == 1) ? $this->sorted($result->result()) : $this->emptyObject('jobs');
        return isset($result[0]) ? $result[0] : array();
    }

    public function getJobQuizes($id)
    {
        $this->db->where('job_quizes.job_id', decode($id));
        $this->db->select('
            job_quizes.*
        ');
        $result = $this->db->get('job_quizes');
        return objToArr($result->result());
    }

    public function getAll($page, $search, $departments, $job_filters, $min_salary, $max_salary, $limit)
    {
        $page = (int)$page;
        $offset = $page > 1 ? (($page-1)*$limit) : 0;
     
        $this->db->from('jobs');
        $this->db->select('
            jobs.*,
            departments.title as department,
            COUNT(DISTINCT('.CF_DB_PREFIX.'job_quizes.job_quiz_id)) as quizes_count,
            COUNT(DISTINCT('.CF_DB_PREFIX.'job_traits.job_trait_id)) as traits_count,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_custom_fields.label) SEPARATOR "-=-++-=-") as field_labels,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_custom_fields.value) SEPARATOR "-=-++-=-") as field_values,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_traits.trait_id) SEPARATOR "-=-++-=-") as trait_ids,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_traits.title) SEPARATOR "-=-++-=-") as trait_titles,
            GROUP_CONCAT(DISTINCT(CONCAT('.CF_DB_PREFIX.'job_filter_values.job_filter_value_id, "(--)", '.CF_DB_PREFIX.'job_filter_values.title)) SEPARATOR "-=-++-=-") as job_filter_values,
            GROUP_CONCAT(DISTINCT(CONCAT('.CF_DB_PREFIX.'job_filters.job_filter_id, "(--)", '.CF_DB_PREFIX.'job_filters.title)) SEPARATOR "-=-++-=-") as job_filter_titles,
            GROUP_CONCAT(DISTINCT(CONCAT('.CF_DB_PREFIX.'job_filter_value_assignments.job_filter_id, "-", '.CF_DB_PREFIX.'job_filter_value_assignments.job_filter_value_id))) AS combined 
        ');
        $this->db->where('jobs.status', 1);
        if (setting('hide-jobs-after-expiry') == 'yes') {
            $this->db->where('DATE('.CF_DB_PREFIX.'jobs.expiry_date) >', 'CURDATE()', false);
        }
        if ($departments) {
            $this->db->where_in('jobs.department_id', $this->sortForSearch($departments));
        }
        if ($min_salary) {
            $this->db->where('jobs.min_salary <=', $min_salary);
        }
        if ($max_salary) {
            $this->db->where('jobs.max_salary <=', $max_salary);
        }
        if ($search) {
            $this->db->group_start()->like('jobs.title', $search)->or_like('jobs.description', $search)->group_end();
        }
        $combined = array();
        if ($job_filters) {
            $job_filter_ids = array_keys($job_filters);
            $job_filter_value_ids = array();
            foreach ($job_filters as $job_filter_id => $job_filter_value_id) {
                foreach ($job_filter_value_id as $v2) {
                    if ($v2) {
                        $combined[] = $job_filter_id.'-'.$v2;
                        $job_filter_value_ids[] = $v2;
                    }
                }
            }
            if ($job_filter_ids && $job_filter_value_ids) {
                $this->db->group_start()
                ->where_in('job_filter_value_assignments.job_filter_id', $job_filter_ids)
                ->where_in('job_filter_value_assignments.job_filter_value_id', $job_filter_value_ids)
                ->group_end();
            }
        }
        $this->db->join('departments', 'departments.department_id = jobs.department_id', 'left');
        $this->db->join('job_custom_fields', 'job_custom_fields.job_id = jobs.job_id', 'left');
        $this->db->join('job_traits', 'job_traits.job_id = jobs.job_id', 'left');
        $this->db->join('job_quizes', 'job_quizes.job_id = jobs.job_id', 'left');
        $this->db->join('job_filter_value_assignments', 'job_filter_value_assignments.job_id = jobs.job_id', 'left');
        $this->db->join('job_filter_values', 'job_filter_values.job_filter_value_id = job_filter_value_assignments.job_filter_value_id', 'left');
        $this->db->join('job_filters', 'job_filters.job_filter_id = job_filter_values.job_filter_id', 'left');        
        $this->db->order_by('jobs.job_id, job_filters.job_filter_id', 'DESC');
        $this->db->group_by('jobs.job_id');
        $this->db->limit($limit, $offset);

        $query = $this->db->get();
        if ($combined) {
            $results = $this->resultsAfterFilters($query->result(), $combined);
        } else {
            $results = $query->result();
        }
        return $this->sorted($results);
    }

    private function resultsAfterFilters($results, $combined)
    {
        $return = array();
        if ($results) {
            $combined = permutationsOfArray($combined);
            foreach ($results as $result) {
                if (in_array($result->combined, $combined)) {
                    $return[] = $result;
                }
            }
        }
        return $return;
    }

    public function getTotal($search, $departments, $min_salary, $max_salary, $job_filters)
    {
        $this->db->from('jobs');
        $this->db->select('
            jobs.job_id,
            GROUP_CONCAT(DISTINCT(CONCAT('.CF_DB_PREFIX.'job_filter_value_assignments.job_filter_id, "-", '.CF_DB_PREFIX.'job_filter_value_assignments.job_filter_value_id))) AS combined
        ');                
        $this->db->where('jobs.status', 1);
        if (setting('hide-jobs-after-expiry') == 'yes') {
            $this->db->where('DATE('.CF_DB_PREFIX.'jobs.expiry_date) >', 'CURDATE()', false);
        }        
        if ($departments) {
            $this->db->where_in('jobs.department_id', $this->sortForSearch($departments));
        } 
        if ($search) {
            $this->db->group_start()->like('jobs.title', $search)->or_like('jobs.description', $search)->group_end();
        }
        if ($min_salary) {
            $this->db->where('jobs.min_salary >=', $min_salary);
        }
        if ($max_salary) {
            $this->db->where('jobs.max_salary <=', $max_salary);
        }

        $combined = array();
        if ($job_filters) {
            $job_filter_ids = array_keys($job_filters);
            $job_filter_value_ids = array();
            foreach ($job_filters as $job_filter_id => $job_filter_value_id) {
                foreach ($job_filter_value_id as $v2) {
                    if ($v2) {
                        $combined[] = $job_filter_id.'-'.$v2;
                        $job_filter_value_ids[] = $v2;
                    }
                }
            }
            if ($job_filter_ids && $job_filter_value_ids) {
                $this->db->group_start()
                ->where_in('job_filter_value_assignments.job_filter_id', $job_filter_ids)
                ->where_in('job_filter_value_assignments.job_filter_value_id', $job_filter_value_ids)
                ->group_end();
            }
        }        
        $this->db->join('job_filter_value_assignments', 'job_filter_value_assignments.job_id = jobs.job_id', 'left');
        $this->db->join('job_filter_values', 'job_filter_values.job_filter_value_id = job_filter_value_assignments.job_filter_value_id', 'left');
        $this->db->group_by('jobs.job_id');

        $query = $this->db->get();
        if ($combined) {
            $results = $this->resultsAfterFilters($query->result(), $combined);
        } else {
            $results = $query->result();
        }
        return count($results);

    }

    public function getAppliedJobs()
    {
        $this->db->select('GROUP_CONCAT('.CF_DB_PREFIX.'job_applications.job_id) as applied');
        $this->db->where('job_applications.candidate_id', $this->candidate_id);
        $this->db->from('job_applications');
        $this->db->group_by('job_applications.candidate_id');
        $result = $this->db->get();
        $result = objToArr($result->result());
        return isset($result[0]['applied']) ? explode(',', $result[0]['applied']) : array();
    }

    public function getAppliedJobsList($limit, $page = '')
    {
        $offset = $page > 1 ? (($page-1)*$limit) : 0;

        $this->db->select('
            jobs.*,
            job_applications.status as job_status,
            job_applications.created_at as applied_on,
            departments.title as department,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_custom_fields.label) SEPARATOR "-=-++-=-") as field_labels,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_custom_fields.value) SEPARATOR "-=-++-=-") as field_values
        ');
        $this->db->where('job_applications.candidate_id', $this->candidate_id);
        $this->db->from('job_applications');
        $this->db->join('jobs', 'jobs.job_id = job_applications.job_id', 'left');
        $this->db->join('departments', 'departments.department_id = jobs.department_id', 'left');
        $this->db->join('job_custom_fields', 'job_custom_fields.job_id = jobs.job_id', 'left');
        $this->db->order_by('job_applications.created_at', 'DESC');
        $this->db->group_by('job_applications.job_id');
        $this->db->limit($limit, $offset);
        $result = $this->db->get();
        $result = objToArr($result->result());
        return $this->sorted($result);
    }

    public function getTotalAppliedJobs()
    {
        $this->db->where('job_applications.candidate_id', $this->candidate_id);
        $this->db->from('job_applications');
        $query = $this->db->get();
        return $query->num_rows();
    }    

    public function getFavoriteJobsList($limit, $page = '')
    {
        $offset = $page > 1 ? (($page-1)*$limit) : 0;

        $this->db->select('
            jobs.*,
            job_favorites.created_at as favorited_on,
            departments.title as department,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_custom_fields.label) SEPARATOR "-=-++-=-") as field_labels,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_custom_fields.value) SEPARATOR "-=-++-=-") as field_values
        ');
        $this->db->where('job_favorites.candidate_id', $this->candidate_id);
        $this->db->from('job_favorites');
        $this->db->join('jobs', 'jobs.job_id = job_favorites.job_id', 'left');
        $this->db->join('departments', 'departments.department_id = jobs.department_id', 'left');
        $this->db->join('job_custom_fields', 'job_custom_fields.job_id = jobs.job_id', 'left');
        $this->db->order_by('job_favorites.created_at', 'DESC');
        $this->db->group_by('job_favorites.job_id');
        $this->db->limit($limit, $offset);
        $result = $this->db->get();
        $result = objToArr($result->result());
        return $this->sorted($result);
    }

    public function getTotalFavoriteJobs()
    {
        $this->db->where('job_favorites.candidate_id', $this->candidate_id);
        $this->db->from('job_favorites');
        $query = $this->db->get();
        return $query->num_rows();
    } 

    public function getReferredJobsList($limit, $page = '')
    {
        $offset = $page > 1 ? (($page-1)*$limit) : 0;

        $this->db->select('
            jobs.*,
            job_referred.created_at as favorited_on,
            job_referred.name,
            job_referred.email,
            job_referred.phone,
            departments.title as department,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_custom_fields.label) SEPARATOR "-=-++-=-") as field_labels,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_custom_fields.value) SEPARATOR "-=-++-=-") as field_values
        ');
        $this->db->where('job_referred.candidate_id', $this->candidate_id);
        $this->db->from('job_referred');
        $this->db->join('jobs', 'jobs.job_id = job_referred.job_id', 'left');
        $this->db->join('departments', 'departments.department_id = jobs.department_id', 'left');
        $this->db->join('job_custom_fields', 'job_custom_fields.job_id = jobs.job_id', 'left');
        $this->db->order_by('job_referred.created_at', 'DESC');
        $this->db->group_by('job_referred.job_id');
        $this->db->limit($limit, $offset);
        $result = $this->db->get();
        $result = objToArr($result->result());
        return $this->sorted($result);
    }

    public function getTotalReferredJobs()
    {
        $this->db->where('job_referred.candidate_id', $this->candidate_id);
        $this->db->from('job_referred');
        $query = $this->db->get();
        return $query->num_rows();
    } 

    public function ifAlreadyReferred()
    {
        $this->db->where('job_id', decode($this->xssCleanInput('job_id')));
        $this->db->where('email', $this->xssCleanInput('email'));
        $this->db->where('candidate_id', $this->candidate_id);
        $result = $this->db->get('job_referred');
        if ($result->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function referJob()
    {
        $data = $this->xssCleanInput();
        $data['candidate_id'] = $this->candidate_id;
        $data['created_at'] = date('Y-m-d G:i:s');
        $data['job_id'] = decode($data['job_id']);
        $this->db->insert('job_referred', $data);
    }

    public function applyJob()
    {
        $data = $this->xssCleanInput();

        $traits = isset($data['traites']) ? $data['traites'] : array();
        $trait_titles = isset($data['traite_titles']) ? $data['traite_titles'] : array();
        $traits_result = array();

        //First Inserting into job application table
        $apply['candidate_id'] = $this->candidate_id;
        $apply['created_at'] = date('Y-m-d G:i:s');
        $apply['job_id'] = decode($data['job_id']);
        if (setting('enable-multiple-resume') == 'no') {
            $apply['resume_id'] = $this->ResumeModel->getFirstDetailedResume();
        } else {
            $apply['resume_id'] = decode($data['resume']);
        }

        //Second checking resume apply restrictions from settings
        $resumeRestrictions = $this->checkResumeApplyRestrictions($apply['resume_id']);
        if ($resumeRestrictions) {
            return array('success' => 'false', 'message' => $resumeRestrictions);
        }

        //Third inserting job application
        $this->db->insert('job_applications', $apply);
        $job_application_id = $this->db->insert_id();

        //Forth Inserting traits to job traits answers
        if ($traits) {
            foreach ($traits as $key => $value) {
                $traits_result[] = $value;
                $answer['candidate_id'] = $this->candidate_id;
                $answer['job_application_id'] = $job_application_id;
                $answer['created_at'] = date('Y-m-d G:i:s');
                $answer['job_trait_id'] = decode($key);
                $answer['job_trait_title'] = isset($trait_titles[$key]) ? $trait_titles[$key] : 'null';
                $answer['rating'] = $value;
                $this->db->insert('job_trait_answers', $answer);
            }
        }

        //Fifth inserting overall trait results to job_applications table //For Job Board results
        $total = array_sum($traits_result);
        $div = count($traits_result)*5;
        $traits_result = $div > 0 ? ceil(($total/$div)*100) : 0;
        $this->db->where('job_application_id', $job_application_id);
        $this->db->update('job_applications', array('traits_result' => $traits_result));

        //Sixth copying any assigned quiz from job_quizes to candidate_quizes
        $job_quizes = $this->getJobQuizes($data['job_id']);
        foreach ($job_quizes as $quiz) {
            $candidate_quiz['candidate_id'] = $this->candidate_id;
            $candidate_quiz['job_id'] = decode($data['job_id']);
            $candidate_quiz['job_quiz_id'] = $quiz['job_quiz_id'];
            $candidate_quiz['quiz_title'] = $quiz['quiz_title'];
            $candidate_quiz['quiz_data'] = $quiz['quiz_data'];
            $candidate_quiz['total_questions'] = $quiz['total_questions'];
            $candidate_quiz['allowed_time'] = $quiz['allowed_time'];
            $candidate_quiz['attempt'] = 0;
            $candidate_quiz['correct_answers'] = 0;
            $candidate_quiz['created_at'] = date('Y-m-d G:i:s');
            $this->db->insert('candidate_quizes', $candidate_quiz);
        }

        //Seventh updating overall results
        $this->updateOverallResultInJobApplication(
            array('candidate_id' => $this->candidate_id, 'job_id' => decode($data['job_id']))
        );

        return array('success' => 'true', 'message' => '');
    }

    public function getCompleteQuiz($quiz_id)
    {
        $result = array();
        $result['quiz'] = $this->AdminQuizModel->get('quiz_id', $quiz_id);
        $result['questions'] = $this->AdminQuizModel->quizQuestions($quiz_id);
        foreach ($result['questions'] as $key => $question) {
            $answers = $this->AdminQuizModel->quizQuestionAnswers($question['quiz_question_id']);
            $result['questions'][$key]['answers'] = $answers;
        }
        return objToArr($result);
    }    

    public function markFavorite($job_id)
    {
        $this->db->where('job_id', decode($job_id));
        $this->db->where('candidate_id', $this->candidate_id);
        $result = $this->db->get('job_favorites');
        if ($result->num_rows() <= 0) {
            $data['candidate_id'] = $this->candidate_id;
            $data['job_id'] = decode($job_id);
            $data['created_at'] = date('Y-m-d G:i:s');
            $this->db->insert('job_favorites', $data);
            return true;
        } else {
            return false;
        }
    }

    public function unmarkFavorite($job_id)
    {
        $data['job_id'] = decode($job_id);
        $data['candidate_id'] = $this->candidate_id;
        $this->db->delete('job_favorites', $data);
    }

    public function getFavorites()
    {
        $this->db->select('GROUP_CONCAT('.CF_DB_PREFIX.'job_favorites.job_id) as ids');
        $this->db->where('candidate_id', $this->candidate_id);
        $result = $this->db->get('job_favorites');
        $result = objToArr($result->result());
        $result = isset($result[0]['ids']) ? explode(',', $result[0]['ids']) : array();
        return $result;
    }

    public function remove($job_id)
    {
        $this->db->delete('jobs', array('job_id' => $job_id));
    }

    public function getAll2($active = true, $srh = '')
    {
        if ($active) {
            $this->db->where('status', 1);
        }
        if ($srh) {
            $this->db->group_start()->like('jobname', $srh)->group_end();
        }
        $this->db->where('job_type !=', 'admin');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }

    private function updateOverallResultInJobApplication($data)
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

    public function sorted($jobs)
    {
        $return = array();
        $jobs = objToArr($jobs);
        foreach ($jobs as $job) {
            $labels = $job['field_labels'] ? explode('-=-++-=-', $job['field_labels']) : array();
            $values = $job['field_values'] ? explode('-=-++-=-', $job['field_values']) : array();
            if (isset($job['job_trait_ids'])) {
                $job_trait_ids = explode('-=-++-=-', $job['job_trait_ids']);
                $trait_titles = explode('-=-++-=-', $job['trait_titles']);
            }
            if (isset($labels[0])) {
                $fields = arrangeSections(array('label' => $labels, 'value' => $values));
            } else {
                $fields = array();
            }
            if (isset($job_trait_ids[0])) {
                $traits = arrangeSections(array('id' => $job_trait_ids, 'title' => $trait_titles));
            } else {
                $traits = array();
            }
            $job['fields'] = $fields;
            $job['traits'] = $traits;
            if (isset($job['job_filter_titles'])) {
            $job['job_filters'] = $this->sortJobFilters($job['job_filter_titles'], $job['job_filter_values'], $job['combined']);
            }
            unset(
                $job['field_labels'],
                $job['field_values'],
                $job['job_trait_ids'],
                $job['trait_titles'],
                $job['job_filter_titles'],
                $job['job_filter_values']
            );
            $return[] = $job;
        }
        return $return;
    }    

    private function sortJobFilters($titles, $values, $combined)
    {
        $filters = $this->JobFilterModel->getAllSimple();
        $explodedTitles = explode('-=-++-=-', $titles);
        $explodedValues = explode('-=-++-=-', $values);
        $explodedCombined = explode(',', $combined);
        $results = array();
        $cleanedTitles = array();
        $cleanedValues = array();
        $cleanedCombined = array();
        foreach ($explodedTitles as $t) {
            $exploded = explode('(--)', $t);
            if (isset($exploded[1])) {
                $cleanedTitles[$exploded[0]] = $exploded[1]; 
            }
        }
        foreach ($explodedValues as $t) {
            $exploded = explode('(--)', $t);
            if (isset($exploded[1])) {
                $cleanedValues[$exploded[0]] = $exploded[1]; 
            }
        }
        foreach ($explodedCombined as $t) {
            $exploded = explode('-', $t);
            if (isset($exploded[1])) {
                $cleanedCombined[$exploded[0]][] = $exploded[1];
            }
        }
        foreach ($cleanedCombined as $job_filter_id => $job_filter_value_ids) {
            if ($filters[$job_filter_id]['front_value'] == 1 && $filters[$job_filter_id]['status'] == 1) {
                $results[$job_filter_id]['title'] = isset($cleanedTitles[$job_filter_id]) ? $cleanedTitles[$job_filter_id] : '';
                foreach ($job_filter_value_ids as $id) {
                    if (isset($cleanedValues[$id])) {
                        $results[$job_filter_id]['values'][] = $cleanedValues[$id];

                    }
                }
            }
        }
        return $results;
    }
   
    private function sortForSearch($data)
    {
        $return = array();
        $array = explode(',', $data);
        foreach ($array as $value) {
            if ($value) {
                $return[] = decode($value);
            }
        }
        return $return;
    }

    private function checkResumeApplyRestrictions($resume_id)
    {
        $setting = setting();
        $resume = $this->ResumeModel->getCompleteResume($resume_id);
        $messages = '';
        
        if (!$resume) {
            $messages .= '<li>'.lang('no_resumes_found').'</li>';
        }

        if ($setting['enable-apply-without-static-resume'] == 'no' && $resume['file'] == '') {
            $messages .= '<li>'.lang('static_resume_required').'</li>';
        }

        if (count($resume['qualifications']) < $setting['min-qualifications-resume-nos-required']) {
            $messages .= '<li>'.lang('at_least_message_1').' "'.$setting['min-qualifications-resume-nos-required'].'" '.lang('qualifications').' '.lang('at_least_message_2').'('.lang('yours').':'.count($resume['qualifications']).')</li>';
        }

        if (count($resume['experiences']) < $setting['min-experiences-resume-nos-required']) {
            $messages .= '<li>'.lang('at_least_message_1').' "'.$setting['min-experiences-resume-nos-required'].'" '.lang('experiences').' '.lang('at_least_message_2').'('.lang('yours').':'.count($resume['experiences']).')</li>';
        }

        if (count($resume['achievements']) < $setting['min-achievements-resume-nos-required']) {
            $messages .= '<li>'.lang('at_least_message_1').' "'.$setting['min-achievements-resume-nos-required'].'" '.lang('achievements').' '.lang('at_least_message_2').'('.lang('yours').':'.count($resume['achievements']).')</li>';
        }

        if (count($resume['references']) < $setting['min-references-resume-nos-required']) {
            $messages .= '<li>'.lang('at_least_message_1').' "'.$setting['min-references-resume-nos-required'].'" '.lang('references').' '.lang('at_least_message_2').'('.lang('yours').':'.count($resume['references']).')</li>';
        }

        if (count($resume['languages']) < $setting['min-languages-resume-nos-required']) {
            $messages .= '<li>'.lang('at_least_message_1').' "'.$setting['min-languages-resume-nos-required'].'" '.lang('languages').' '.lang('at_least_message_2').'('.lang('yours').':'.count($resume['languages']).')</li>';
        }

        if (count($resume['skills']) < $setting['min-skills-resume-nos-required']) {
            $messages .= '<li>'.lang('at_least_message_1').' "'.$setting['min-skills-resume-nos-required'].'" '.lang('skills').' '.lang('at_least_message_2').'('.lang('yours').':'.count($resume['skills']).')</li>';
        }

        return $messages ? "<ul>".$messages."</ul>" : "";
    }
}