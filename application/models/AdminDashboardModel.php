<?php

class AdminDashboardModel extends CI_Model
{
    public function getJobs()
    {
        //Setting session for every parameter of the request
        $this->setSessionValues();

        //First getting total records
        $total = $this->getTotalJobs();
        
        //Setting filters, search and pagination via posted session variables
        $page = $this->getSessionValues('dashboard_jobs_page', 1);
        $per_page = 5;

        $per_page = $per_page < $total ? $per_page : $total;
        $limit = $per_page;
        $offset = ($page == 1 ? 0 : ($page-1)) * $per_page;
        $offset = $offset < 0 ? 0 : $offset;

        $this->db->select('
            jobs.*,
            companies.title as company,
            departments.title as department,
            COUNT(DISTINCT('.CF_DB_PREFIX.'job_applications.job_application_id)) as total_count,
            COUNT(DISTINCT(jas.job_application_id)) as shortlisted_count,
            COUNT(DISTINCT(jai.job_application_id)) as interviewed_count,
            COUNT(DISTINCT(jah.job_application_id)) as hired_count,
            COUNT(DISTINCT(jar.job_application_id)) as rejected_count
        ');
        $this->db->where('jobs.status', 1);
        $this->db->join('companies', 'companies.company_id = jobs.company_id', 'left');
        $this->db->join('departments', 'departments.department_id = jobs.department_id', 'left');
        $this->db->join('job_applications', 'job_applications.job_id = jobs.job_id', 'left');
        $this->db->join('job_applications as jas', 'jas.job_id = jobs.job_id AND jas.status = "shortlisted"', 'left');
        $this->db->join('job_applications as jai', 'jai.job_id = jobs.job_id AND jai.status = "interviewed"', 'left');
        $this->db->join('job_applications as jah', 'jah.job_id = jobs.job_id AND jah.status = "hired"', 'left');
        $this->db->join('job_applications as jar', 'jar.job_id = jobs.job_id AND jar.status = "rejected"', 'left');
        $this->db->from('jobs');
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
        $this->db->where('jobs.status', 1);
        $this->db->join('companies', 'companies.company_id = jobs.company_id', 'left');
        $this->db->join('departments', 'departments.department_id = jobs.department_id', 'left');
        $this->db->join('job_applications as jas', 'jas.job_id = jobs.job_id AND jas.status = "hired"', 'left');
        $this->db->from('jobs');
        $this->db->group_by('jobs.job_id');
        $query = $this->db->get();
        return $query->num_rows();
    }     
}