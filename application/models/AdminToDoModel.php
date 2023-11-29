<?php

class AdminToDoModel extends CI_Model
{
    public function getToDo($column, $value)
    {
        $this->db->where($column, $value);
        $result = $this->db->get('to_dos');
        return ($result->num_rows() == 1) ? objToArr($result->row(0)) : $this->emptyObject('to_dos');
    }

    public function getTodos()
    {
        //Setting session for every parameter of the request
        $this->setSessionValues();

        //First getting total records
        $total = $this->getTotalTodos();
        
        //Setting filters, search and pagination via posted session variables
        $page = $this->getSessionValues('dashboard_todos_page', 1);
        $per_page = 5;

        $per_page = $per_page < $total ? $per_page : $total;
        $limit = $per_page;
        $offset = ($page == 1 ? 0 : ($page-1)) * $per_page;
        $offset = $offset < 0 ? 0 : $offset;

        $this->db->select('
            to_dos.*,
        ');
        $this->db->where('to_dos.user_id', $this->session->userdata('admin')['user_id']);
        $this->db->from('to_dos');
        $this->db->order_by('to_dos.created_at', 'DESC');
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

    public function getTotalTodos()
    {
        $this->db->where('to_dos.user_id', $this->session->userdata('admin')['user_id']);
        $this->db->from('to_dos');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function todoStatus($id, $status)
    {
        $this->db->where('to_dos.to_do_id', $id);
        $this->db->update('to_dos', array('status' => $status));
    } 

    public function store()
    {
        $data = $this->xssCleanInput();
        $to_do_id = $data['to_do_id'];

        if ($to_do_id) {
            $data['updated_at'] = date('Y-m-d G:i:s');
            $this->db->where('to_do_id', $to_do_id);
            $this->db->update('to_dos', $data);
        } else {
            $data['created_at'] = date('Y-m-d G:i:s');
            $data['updated_at'] = date('Y-m-d G:i:s');
            $data['user_id'] = $this->session->userdata('admin')['user_id'];
            $this->db->insert('to_dos', $data);
        }
    }

    public function remove($to_do_id)
    {
        $this->db->delete('to_dos', array('to_do_id' => $to_do_id));
    }    
}