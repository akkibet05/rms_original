<?php

class AdminJobModel extends CI_Model
{
    protected $table = 'jobs';
    protected $key = 'job_id';

    public function getJob($column, $value)
    {
        $this->db->where($column, $value);
        $this->db->select('
            jobs.*,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_traits.trait_id)) as traits,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_quizes.quiz_id)) as quizes,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_filter_value_assignments.job_filter_id)) as job_filter_ids,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_filter_value_assignments.job_filter_value_id)) as job_filter_value_ids,
        ');
        $this->db->join('job_traits', 'job_traits.job_id = jobs.job_id', 'left');
        $this->db->join('job_quizes', 'job_quizes.job_id = jobs.job_id', 'left');
        $this->db->join('job_filter_value_assignments', 'job_filter_value_assignments.job_id = jobs.job_id', 'left');
        $this->db->group_by('jobs.job_id');
        $result = $this->db->get('jobs');
        return ($result->num_rows() == 1) ? $result->row(0) : $this->emptyObject('jobs');
    }

    public function getAll($active = true, $srh = '')
    {
        if ($active) {
            $this->db->where('status', 1);
        }
        if ($srh) {
            $this->db->group_start()->like('title', $srh)->group_end();
        }
        $this->db->from($this->table);
        $query = $this->db->get();
        return objToArr($query->result());
    }

    public function getTotalJobs()
    {
        $this->db->where('status', 1);
        $query = $this->db->get('jobs');
        return $query->num_rows();
    }

    public function getPopularJobs()
    {
        //Setting session for every parameter of the request
        $this->setSessionValues();
        $limit = setting('charts-limit');

        $applications_count = $this->getSessionValues('applied_check');
        $favorites_count = $this->getSessionValues('favorited_check');
        $referred_count = $this->getSessionValues('referred_check');

        $this->db->where('jobs.status', 1);
        $this->db->select('
            jobs.title as label,
            COUNT(DISTINCT(CONCAT('.CF_DB_PREFIX.'job_applications.job_application_id))) as applications_count,
            COUNT(DISTINCT(CONCAT('.CF_DB_PREFIX.'job_favorites.job_id,"-",'.CF_DB_PREFIX.'job_favorites.candidate_id))) as favorites_count,
            COUNT(DISTINCT(CONCAT('.CF_DB_PREFIX.'job_referred.job_id,"-",'.CF_DB_PREFIX.'job_referred.candidate_id))) as referred_count,
        ');
        $this->db->join('job_favorites', 'job_favorites.job_id = jobs.job_id', 'left');
        $this->db->join('job_applications', 'job_applications.job_id = jobs.job_id', 'left');
        $this->db->join('job_referred', 'job_referred.job_id = jobs.job_id', 'left');
        $this->db->group_by('jobs.job_id');
        $this->db->order_by('jobs.job_id', 'ASC');
        $this->db->limit($limit, 0);
        $result = $this->db->get('jobs');
        $result = $result->result();
        $consolidated = array();
        foreach ($result as $key => $value) {
            $total = 0;
            if ($applications_count) {
                $total = $total + $value->applications_count;
            }
            if ($favorites_count) {
                $total = $total + $value->favorites_count;
            }
            if ($referred_count) {
                $total = $total + $value->referred_count;
            }
            $consolidated[] = array('label' => $value->label, 'value' => $total);
        }
        return json_encode($consolidated);
    }

    public function storeJob($edit = null)
    {
        $data = $this->xssCleanInput();

        //Replacing &nbsp with space
        $string = htmlentities($_POST['description']);
        $data['description'] = str_replace("&nbsp;", " ", $string);
        $data['description'] = html_entity_decode($data['description']);
        $data['description'] = trim(preg_replace('/(&nbsp;)+|\s\K\s+/',' ',$data['description']));
        $data['slug'] = $this->getSlug($data['title'], $data['slug'], encode($edit));
        $data['created_by'] = adminSession();

        //Separating custom values
        $custom_field_ids = isset($data['custom_field_ids']) ? $data['custom_field_ids'] : array();
        $labels = isset($data['labels']) ? $data['labels'] : array();
        $values = isset($data['values']) ? $data['values'] : array();
        $customFields = array('custom_field_id' => $custom_field_ids, 'label' => $labels, 'value' => $values);

        //Separting traits and quizes and filters
        $traits = isset($data['traits']) ? $data['traits'] : array();
        $quizes = isset($data['quizes']) ? $data['quizes'] : array();
        $filters = isset($data['filters']) ? $data['filters'] : array();

        //Removing variables
        unset($data['traits'], $data['quizes'], $data['labels'], $data['values'], $data['custom_field_ids'], $data['filters']);

        if ($edit) {
            $this->db->where('job_id', $edit);
            $data['updated_at'] = date('Y-m-d G:i:s');
            $this->db->update('jobs', $data);
            $this->insertTraits($traits, $edit);
            $this->insertQuizes($quizes, $edit);
            $this->insertCustomFields($customFields, $edit);
            $this->assignJobFilterValues($filters, $edit);
        } else {
            $data['created_at'] = date('Y-m-d G:i:s');
            $data['status'] = 1;
            $this->db->insert('jobs', $data);
            $id = $this->db->insert_id();
            $this->insertTraits($traits, $id);
            $this->insertQuizes($quizes, $id);
            $this->insertCustomFields($customFields, $id);
            $this->assignJobFilterValues($filters, $id);
            return $id;
        }
    }

    public function ifAlreadyApplied()
    {
        $data = $this->xssCleanInput();
        $this->db->where('job_applications.job_id', $data['job_id']);
        $this->db->where('job_applications.candidate_id', $data['candidate_id']);
        $result = $this->db->get('job_applications');
        return ($result->num_rows() > 0) ? true : false;
    }

    public function importJobs($jobs)
    {
        //inserting jobs
        foreach ($jobs as $job) {
            $title = issetVal($job, 1);
            $title = $title ? $title : slugify();
            $department_id = issetVal($job, 0);
            $expiry_date = issetVal($job, 9);
            $expiry_date = $expiry_date ? date('Y-m-d', strtotime($expiry_date)) : dateAfterNumberOfDays(30);
            $published_at = issetVal($job, 10);
            $published_at = $published_at ? date('Y-m-d', strtotime($published_at)) : date('Y-m-d');
            $slug = issetVal($job, 2);
            $slug = $this->getSlug($title, '', '');
            $data['department_id'] = $this->getDepartmentIdForJob($department_id);
            $data['title'] = $title;
            $data['slug'] = $slug;
            $data['description'] = issetVal($job, 3);
            $data['meta_keywords'] = issetVal($job, 4);
            $data['meta_description'] = issetVal($job, 5);
            $data['min_salary'] = issetVal($job, 6);
            $data['max_salary'] = issetVal($job, 7);
            $data['number_of_positions'] = issetVal($job, 8, '1');
            $data['expiry_date'] = $expiry_date;
            $data['published_at'] = $published_at;
            $data['status'] = issetVal($job, 11, '1');
            $data['is_static_allowed'] = issetVal($job, 12, '1');
            $data['created_by'] = adminSession();
            $data['created_at'] = date('Y-m-d G:i:s');
            $data['updated_at'] = date('Y-m-d G:i:s');
            $this->db->insert('jobs', $data);
        }

        return true;
    }

    private function getDepartmentIdForJob($department_id)
    {
        //Getting all departments
        $departments = objToArr($this->AdminDepartmentModel->getAll());

        //First sorting departments
        $sorted_departments = array();
        foreach ($departments as $department) {
            $sorted_departments[$department['department_id']] = $department['title'];
        }

        //If department_id is empty
        if (!$department_id) {
            reset($sorted_departments);
            return key($sorted_departments);            
        }

        //If department_id is numeric/id
        if (is_numeric($department_id)) {
            return $department_id;
        }

        //If department_id is a string
        foreach ($sorted_departments as $did => $department) {
            if (strtolower($department_id) == strtolower($department)) {
                return $did;
            }
        }

        //If not found, create the department and return id
        $new['title'] = $department_id;
        $new['image'] = '';
        $new['status'] = 1;
        $new['updated_at'] = date('Y-m-d G:i:s');
        $new['created_at'] = date('Y-m-d G:i:s');
        $this->db->insert('departments', $new);
        return $this->db->insert_id();
    }

    public function applyForCandidateByAdmin()
    {
        $data = $this->xssCleanInput();

        $traits = isset($data['traits']) ? $data['traits'] : array();
        $trait_titles = isset($data['trait_titles']) ? $data['trait_titles'] : array();
        $traits_result = array();

        //First Inserting into job application table
        $apply['candidate_id'] = $data['candidate_id'];
        $apply['created_at'] = date('Y-m-d G:i:s');
        $apply['job_id'] = $data['job_id'];
        if (setting('enable-multiple-resume') == 'no') {
            $apply['resume_id'] = $this->ResumeModel->getFirstDetailedResume($data['candidate_id']);
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
                $answer['candidate_id'] = $data['candidate_id'];
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
            $candidate_quiz['candidate_id'] = $data['candidate_id'];
            $candidate_quiz['job_id'] = $data['job_id'];
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
            array('candidate_id' => $data['candidate_id'], 'job_id' => $data['job_id'])
        );

        return array('success' => 'true', 'message' => '');        
    }

    public function getSlug($title, $slug, $edit)
    {
        $slug = $slug ? $slug : slugify($title);
        $numbers = range(1, 500);
        $edit = decode($edit);
        array_unshift($numbers , '');
        foreach ($numbers as $number) {
            $completeSlug = $slug.($number ? '-'.$number : '');
            $this->db->where('slug', $completeSlug);
            if ($edit) {
                $this->db->where('job_id !=', $edit);
            }
            $query = $this->db->get('jobs');
            $count = $query->num_rows();
            if ($count == 0) {
                return $completeSlug;
            }
        }
    }

    public function insertTraits($traits, $job_id)
    {
        //First deleting
        $this->db->delete('job_traits', array('job_id' => $job_id));

        //Getting traits for new
        $this->db->where_in('trait_id', ($traits ? $traits : array(0)));
        $traits = $this->db->get('traits');
        $traits = objToArr($traits->result());

        //Inserting new traits
        foreach ($traits as $key => $value) {
            $data['created_at'] = date('Y-m-d G:i:s');
            $data['title'] = $value['title'];
            $data['trait_id'] = $value['trait_id'];
            $data['job_id'] = $job_id;
            $this->db->insert('job_traits', $data);
        }
    }

    public function insertQuizes($quizes, $job_id)
    {
        //First deleting
        $this->db->delete('job_quizes', array('job_id' => $job_id));

        //Second inserting quiz with quiz data
        foreach ($quizes as $quiz_id) {
            $quiz = $this->AdminQuizModel->getCompleteQuiz($quiz_id);
            $data['quiz_data'] = json_encode($quiz);
            $data['job_id'] = $job_id;
            $data['quiz_id'] = $quiz_id;
            $data['quiz_title'] = $quiz['quiz']['title'];
            $data['total_questions'] = count($quiz['questions']);
            $data['allowed_time'] = $quiz['quiz']['allowed_time'];
            $data['created_at'] = date('Y-m-d G:i:s');
            $this->db->insert('job_quizes', $data);
        }
    }

    public function insertCustomFields($customFields, $job_id)
    {
        $data = arrangeSections($customFields);
        foreach ($data as $d) {
            if ($d['custom_field_id']) {
                $this->db->where('job_custom_fields.custom_field_id', $d['custom_field_id']);
                $this->db->update('job_custom_fields', $d);
            } else {
                unset($d['custom_field_id']);
                $d['job_id'] = $job_id;
                $this->db->insert('job_custom_fields', $d);
            }
        }
    }

    public function assignJobFilterValues($filters, $job_id)
    {
        $all_value_ids = array();
        foreach ($filters as $job_filter_id => $job_filter_value_ids) {
            foreach ($job_filter_value_ids as $job_filter_value_id) {
                $existing_filter = $this->checkExistingJobFilter($job_filter_value_id, $job_id);
                if ($job_filter_value_id && !$existing_filter) {
                    $insert['job_id'] = $job_id;
                    $insert['job_filter_value_id'] = $job_filter_value_id;
                    $insert['job_filter_id'] = $job_filter_id;
                    $this->db->insert('job_filter_value_assignments', $insert);
                }
            }
            $all_value_ids = array_merge($all_value_ids, $job_filter_value_ids);
        }

        //Deleting any if not in input
        if ($all_value_ids) {
            $this->db->where('job_id', $job_id);
            $this->db->where_not_in('job_filter_value_id', array_values($all_value_ids));
            $this->db->delete('job_filter_value_assignments');
        }
    }

    private function checkExistingJobFilter($job_filter_value_id, $job_id)
    {
        $this->db->where('job_id', $job_id);
        $this->db->where('job_filter_value_id', $job_filter_value_id);
        $query = $this->db->get('job_filter_value_assignments');
        return $query->num_rows() > 0 ? true : false;
    }

    public function changeStatus($job_id, $status)
    {
        $this->db->where('job_id', $job_id);
        $this->db->update('jobs', array('status' => ($status == 1 ? 0 : 1)));
    }

    public function remove($job_id)
    {
        //First remove job
        $this->db->delete('jobs', array('job_id' => $job_id));

        //Second remove job quizes
        $this->db->delete('job_quizes', array('job_id' => $job_id));
        
        //Third remove job traits
        $this->db->delete('job_traits', array('job_id' => $job_id));

        //Forth remove custom fields
        $this->db->delete('job_custom_fields', array('job_id' => $job_id));

        //Fifth remove job applications
        $this->db->delete('job_applications', array('job_id' => $job_id));

        //Sixth remove job favorites
        $this->db->delete('job_favorites', array('job_id' => $job_id));

        //Seventh remove job referred
        $this->db->delete('job_referred', array('job_id' => $job_id));

        //Eighth remove candidate interviews
        $this->db->delete('candidate_interviews', array('job_id' => $job_id));

        //Ninth remove candidate quizes
        $this->db->delete('candidate_quizes', array('job_id' => $job_id));
    }

    public function bulkAction()
    {
        $data = objToArr(json_decode($this->xssCleanInput('data')));
        $action = $data['action'];
        $ids = $data['ids'];
        switch ($action) {
            case "activate":
                $this->db->where_in('job_id', $ids);
                $this->db->update('jobs', array('status' => 1));
            break;
            case "deactivate":
                $this->db->where_in('job_id', $ids);
                $this->db->update('jobs', array('status' => '0'));
            break;
        }
    }

    public function valueExist($field, $value, $edit = false)
    {
        $this->db->where($field, $value);
        if ($edit) {
            $this->db->where('job_id !=', $edit);
        }
        $query = $this->db->get('jobs');
        return $query->num_rows() > 0 ? true : false;
    }

    public function getFields($job_id)
    {
        $this->db->where('job_id', $job_id);
        $this->db->from('job_custom_fields');
        $query = $this->db->get();
        return $query->result();
    }

    public function getJobsForCSV($ids)
    {
        $this->db->from('jobs');
        $this->db->select('
            jobs.*,
            departments.title as department,
            COUNT(DISTINCT('.CF_DB_PREFIX.'job_applications.job_id)) as applications_count,
            COUNT(DISTINCT('.CF_DB_PREFIX.'job_favorites.job_id)) as favorites_count,
            COUNT(DISTINCT('.CF_DB_PREFIX.'job_referred.job_id)) as referred_count,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_traits.title)) as traits,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_filter_values.title) SEPARATOR ",") as job_filter_values
        ');
        $this->db->where_in('jobs.job_id', explode(',', $ids));
        $this->db->join('companies', 'companies.company_id = jobs.company_id', 'left');
        $this->db->join('departments', 'departments.department_id = jobs.department_id', 'left');
        $this->db->join('job_applications', 'job_applications.job_id = jobs.job_id', 'left');
        $this->db->join('job_favorites', 'job_favorites.job_id = jobs.job_id', 'left');
        $this->db->join('job_referred', 'job_referred.job_id = jobs.job_id', 'left');
        $this->db->join('job_traits', 'job_traits.job_id = jobs.job_id', 'left');
        $this->db->join('job_filter_value_assignments', 'job_filter_value_assignments.job_id = jobs.job_id', 'left');
        $this->db->join('job_filter_values', 'job_filter_values.job_filter_value_id = job_filter_value_assignments.job_filter_value_id', 'left');        
        $this->db->group_by('jobs.job_id');
        $query = $this->db->get();
        return $query->result();
    }    

    public function removeCustomField($custom_field_id)
    {
        $this->db->delete('job_custom_fields', array('custom_field_id' => $custom_field_id));
    }    

    public function jobsList()
    {
        $request = $this->input->post();
        $columns = array(
            "",
            "jobs.title",
            "departments.department_id",
            "",
            "applications_count",
            "favorites_count",
            "referred_count",
            "traits_count",
            "jobs.created_at",
            "jobs.status",
        );
        $orderColumn = $columns[($request['order'][0]['column'] == 0 ? 5 : $request['order'][0]['column'])];
        $orderDirection = $request['order'][0]['dir'];
        $srh = $request['search']['value'];
        $limit = $request['length'];
        $offset = $request['start'];
        $limit_team = setting('limit-team-members-to-only-view-their-created-jobs');

        $this->db->from('jobs');
        $this->db->select('
            jobs.job_id,
            jobs.company_id,
            jobs.department_id,
            jobs.title,
            jobs.status,
            jobs.created_at,
            companies.title as company,
            departments.title as department,
            COUNT(DISTINCT('.CF_DB_PREFIX.'job_applications.job_application_id)) as applications_count,
            COUNT(DISTINCT(CONCAT('.CF_DB_PREFIX.'job_favorites.candidate_id, '.CF_DB_PREFIX.'job_favorites.job_id))) as favorites_count,
            COUNT(DISTINCT(CONCAT('.CF_DB_PREFIX.'job_referred.candidate_id, '.CF_DB_PREFIX.'job_referred.job_id))) as referred_count,
            COUNT(DISTINCT('.CF_DB_PREFIX.'job_traits.trait_id)) as traits_count,
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'job_filter_values.title) SEPARATOR ",") as job_filter_values,
            GROUP_CONCAT(DISTINCT(CONCAT('.CF_DB_PREFIX.'job_filter_value_assignments.job_filter_id, "-", '.CF_DB_PREFIX.'job_filter_value_assignments.job_filter_value_id))) AS combined
        ');

        if ($srh) {
            $this->db->group_start()->like('jobs.title', $srh)->or_like('jobs.description', $srh)->group_end();
        }
        if (isset($request['status']) && $request['status'] != '') {
            $this->db->where('jobs.status', $request['status']);
        }
        if (isset($request['company']) && $request['company'] != '') {
            $this->db->where('companies.company_id', $request['company']);
        }
        if (isset($request['department']) && $request['department'] != '') {
            $this->db->where('departments.department_id', $request['department']);
        }
        if ($limit_team == 'yes' && adminSession('user_type') == 'team') {
            $this->db->where('jobs.created_by', adminSession());
        }
        $combined = array();
        if (isset($request['job_filters'])) {
            $job_filter_ids = array();
            $job_filter_value_ids = array();
            foreach ($request['job_filters'] as $job_filter_id => $job_filter_value_id) {
                if ($job_filter_id && $job_filter_value_id) {
                    $combined[] = $job_filter_id.'-'.$job_filter_value_id;
                    $job_filter_ids[] = $job_filter_id;
                    $job_filter_value_ids[] = $job_filter_value_id;
                }
            }
            if ($job_filter_ids && $job_filter_value_ids) {
                $this->db->group_start()
                ->where_in('job_filter_value_assignments.job_filter_id', $job_filter_ids)
                ->where_in('job_filter_value_assignments.job_filter_value_id', $job_filter_value_ids)
                ->group_end();
            }
        }
        $this->db->join('companies', 'companies.company_id = jobs.company_id', 'left');
        $this->db->join('departments', 'departments.department_id = jobs.department_id', 'left');
        $this->db->join('job_applications', 'job_applications.job_id = jobs.job_id', 'left');
        $this->db->join('job_favorites', 'job_favorites.job_id = jobs.job_id', 'left');
        $this->db->join('job_referred', 'job_referred.job_id = jobs.job_id', 'left');
        $this->db->join('job_traits', 'job_traits.job_id = jobs.job_id', 'left');
        $this->db->join('job_filter_value_assignments', 'job_filter_value_assignments.job_id = jobs.job_id', 'left');
        $this->db->join('job_filter_values', 'job_filter_values.job_filter_value_id = job_filter_value_assignments.job_filter_value_id', 'left');
        $this->db->group_by('jobs.job_id');
        
        //Enabling multi cross relationed filter search
        if (isset($request['job_filters']) && $combined) {
            $combined = combinationsOfArray($combined, count($combined));
            $c = 1;
            foreach ($combined as $comb) {
                if ($c == 1) {
                    $this->db->having('combined', $comb);
                } else {
                    $this->db->or_having('combined', $comb);
                }
                $c++;
            }
        }

        $this->db->order_by($orderColumn, $orderDirection);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();

        $result = array(
            'data' => $this->prepareDataForTable($query->result()),
            'recordsTotal' => $this->getTotal(),
            'recordsFiltered' => $this->getTotal($srh, $request),
        );

        return $result;
    }

    public function getTotal($srh = false, $request = '')
    {
        $this->db->from('jobs');
        $this->db->select('
            jobs.job_id,
            GROUP_CONCAT(DISTINCT(CONCAT('.CF_DB_PREFIX.'job_filter_value_assignments.job_filter_id, "-", '.CF_DB_PREFIX.'job_filter_value_assignments.job_filter_value_id))) AS combined
        ');        
        if ($srh) {
            $this->db->group_start()->like('jobs.title', $srh)->or_like('jobs.description', $srh)->group_end();
        }
        if (isset($request['status']) && $request['status'] != '') {
            $this->db->where('jobs.status', $request['status']);
        }
        if (isset($request['company']) && $request['company'] != '') {
            $this->db->where('companies.company_id', $request['company']);
        }
        if (isset($request['department']) && $request['department'] != '') {
            $this->db->where('departments.department_id', $request['department']);
        }
        $limit_team = setting('limit-team-members-to-only-view-their-created-jobs');
        if ($limit_team == 'yes' && adminSession('user_type') == 'team') {
            $this->db->where('jobs.created_by', adminSession());
        }

        $combined = array();        
        if (isset($request['job_filters'])) {
            $job_filter_ids = array();
            $job_filter_value_ids = array();
            foreach ($request['job_filters'] as $job_filter_id => $job_filter_value_id) {
                if ($job_filter_id && $job_filter_value_id) {
                    $job_filter_ids[] = $job_filter_id;
                    $job_filter_value_ids[] = $job_filter_value_id;
                    $combined[] = $job_filter_id.'-'.$job_filter_value_id;
                }
            }
            if ($job_filter_ids && $job_filter_value_ids) {
                $this->db->group_start()
                ->where_in('job_filter_value_assignments.job_filter_id', $job_filter_ids)
                ->where_in('job_filter_value_assignments.job_filter_value_id', $job_filter_value_ids)
                ->group_end();
            }
        }
        $this->db->join('companies', 'companies.company_id = jobs.company_id', 'left');
        $this->db->join('departments', 'departments.department_id = jobs.department_id', 'left');
        $this->db->join('job_applications', 'job_applications.job_id = jobs.job_id', 'left');
        $this->db->join('job_favorites', 'job_favorites.job_id = jobs.job_id', 'left');
        $this->db->join('job_referred', 'job_referred.job_id = jobs.job_id', 'left');
        $this->db->join('job_traits', 'job_traits.job_id = jobs.job_id', 'left');
        $this->db->join('job_filter_value_assignments', 'job_filter_value_assignments.job_id = jobs.job_id', 'left');
        $this->db->join('job_filter_values', 'job_filter_values.job_filter_value_id = job_filter_value_assignments.job_filter_value_id', 'left');
        $this->db->group_by('jobs.job_id');

        //Enabling multi cross relationed filter search
        if (isset($request['job_filters']) && $combined) {
            $combined = combinationsOfArray($combined, count($combined));
            $c = 1;
            foreach ($combined as $comb) {
                if ($c == 1) {
                    $this->db->having('combined', $comb);
                } else {
                    $this->db->or_having('combined', $comb);
                }
                $c++;
            }
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    private function prepareDataForTable($jobs)
    {
        $sorted = array();
        foreach ($jobs as $j) {
            $actions = '';
            $j = objToArr($j);
            if ($j['status'] == 1) {
                $button_text = lang('active');
                $button_class = 'success';
                $button_title = lang('click_to_deactivate');
            } else {
                $button_text = lang('inactive');
                $button_class = 'danger';
                $button_title = lang('click_to_activate');
            }
            if (allowedTo('edit_jobs')) { 
            $actions .= '
                <button type="button" class="btn btn-primary btn-xs create-or-edit-job" data-id="'.encode($j['job_id']).'"><i class="far fa-edit"></i></button>
            ';
            }
            if (allowedTo('delete_jobs')) { 
            $actions .= '
                <button type="button" class="btn btn-danger btn-xs delete-job" data-id="'.encode($j['job_id']).'"><i class="far fa-trash-alt"></i></button>
            ';
            }
            $sorted[] = array(
                "<input type='checkbox' class='minimal single-check' data-id='".$j['job_id']."' />",
                esc_output($j['title']),
                $j['department'] ? esc_output($j['department']) : '---',
                $j['job_filter_values'] ? esc_output($j['job_filter_values']) : '---',
                $j['applications_count'],
                $j['favorites_count'],
                $j['referred_count'],
                $j['traits_count'],
                dateLang($j['created_at']),
                '<button type="button" title="'.$button_title.'" class="btn btn-'.$button_class.' btn-xs change-job-status" data-status="'.$j['status'].'" data-id="'.$j['job_id'].'">'.$button_text.'</button>',
                $actions
            );
        }
        return $sorted;
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

    public function getJobQuizes($id)
    {
        $this->db->where('job_quizes.job_id', $id);
        $this->db->select('
            job_quizes.*
        ');
        $result = $this->db->get('job_quizes');
        return objToArr($result->result());
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

}