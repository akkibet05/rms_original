<?php

class AdminBlogModel extends CI_Model
{
    protected $table = 'blogs';
    protected $key = 'blog_id';

    public function getBlog($column, $value)
    {
        $this->db->where($column, $value);
        $result = $this->db->get('blogs');
        return ($result->num_rows() == 1) ? $result->row(0) : $this->emptyObject('blogs');
    }

    public function changeStatus($blog_id, $status)
    {
        $this->db->where('blog_id', $blog_id);
        $this->db->update('blogs', array('status' => ($status == 1 ? 0 : 1)));
    }

    public function store($edit = null, $image = '')
    {
        $data = $this->xssCleanInput();
        if ($image) {
            $data['image'] = $image;
        }
        //Replacing &nbsp with space
        $string = htmlentities($_POST['description']);
        $data['description'] = str_replace("&nbsp;", " ", $string);
        $data['description'] = html_entity_decode($data['description']);
        $data['description'] = trim(preg_replace('/(&nbsp;)+|\s\K\s+/',' ',$data['description']));;

        if ($edit) {
            $this->db->where('blog_id', $edit);
            $data['updated_at'] = date('Y-m-d G:i:s');
            $this->db->update('blogs', $data);
            return $edit;
        } else {
            $data['created_at'] = date('Y-m-d G:i:s');
            $this->db->insert('blogs', $data);
            $id = $this->db->insert_id();
            return $id;
        }
    }

    public function remove($blog_id)
    {
        $this->db->delete('blogs', array('blog_id' => $blog_id));
    }

    public function bulkAction()
    {
        $data = objToArr(json_decode($this->xssCleanInput('data')));
        $action = $data['action'];
        $ids = $data['ids'];
        switch ($action) {
            case "activate":
                $this->db->where_in('blog_id', $ids);
                $this->db->update('blogs', array('status' => 1));
            break;
            case "deactivate":
                $this->db->where_in('blog_id', $ids);
                $this->db->update('blogs', array('status' => '0'));
            break;
        }
    }

    public function valueExist($field, $value, $edit = false)
    {
        $this->db->where($field, $value);
        if ($edit) {
            $this->db->where('blog_id !=', $edit);
        }
        $query = $this->db->get('blogs');
        return $query->num_rows() > 0 ? true : false;
    }

    public function getAll($active = true, $srh = '')
    {
        if ($active) {
            $this->db->where('status', 1);
        }
        if ($srh) {
            $this->db->group_start()->like('blogname', $srh)->group_end();
        }
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }

    public function blogsList()
    {
        $request = $this->input->post();
        $columns = array(
            "",
            "blogs.title",
            "blogs.created_at",
            "blogs.status",
        );
        $orderColumn = $columns[($request['order'][0]['column'] == 0 ? 5 : $request['order'][0]['column'])];
        $orderDirection = $request['order'][0]['dir'];
        $srh = $request['search']['value'];
        $limit = $request['length'];
        $offset = $request['start'];

        $this->db->from('blogs');
        $this->db->select('
            blogs.*
        ');
        if ($srh) {
            $this->db->group_start()->like('title', $srh)->group_end();
        }
        if (isset($request['status']) && $request['status'] != '') {
            $this->db->where('blogs.status', $request['status']);
        }
        $this->db->group_by('blogs.blog_id');
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
        $this->db->from('blogs');
        if ($srh) {
            $this->db->group_start()->like('title', $srh)->group_end();
        }
        if (isset($request['status']) && $request['status'] != '') {
            $this->db->where('blogs.status', $request['status']);
        }
        $this->db->group_by('blogs.blog_id');
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function prepareDataForTable($blogs)
    {
        $sorted = array();
        foreach ($blogs as $b) {
            $actions = '';
            $b = objToArr($b);
            if ($b['status'] == 1) {
                $button_text = lang('active');
                $button_class = 'success';
                $button_title = lang('click_to_deactivate');
            } else {
                $button_text = lang('inactive');
                $button_class = 'danger';
                $button_title = lang('click_to_activate');
            }
            if (allowedTo('edit_blog')) { 
            $actions .= '
                <button type="button" class="btn btn-primary btn-xs create-or-edit-blog" data-id="'.$b['blog_id'].'"><i class="far fa-edit"></i></button>
            ';
            }
            if (allowedTo('delete_blog')) { 
            $actions .= '
                <button type="button" class="btn btn-danger btn-xs delete-blog" data-id="'.$b['blog_id'].'"><i class="far fa-trash-alt"></i></button>
            ';
            }
            $default_image = base_url().'assets/images/not-found.png';
            $sorted[] = array(
                "<input type='checkbox' class='minimal single-check' data-id='".$b['blog_id']."' />",
                esc_output($b['title']),
                dateLang($b['created_at']),
                '<button type="button" title="'.$button_title.'" class="btn btn-'.$button_class.' btn-xs change-blog-status" data-status="'.$b['status'].'" data-id="'.$b['blog_id'].'">'.$button_text.'</button>',
                $actions
            );
        }
        return $sorted;
    }   
}