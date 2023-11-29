<?php

class AdminUserModel extends CI_Model
{
    protected $table = 'users';
    protected $key = 'user_id';

    public function login($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $this->db->where('status', 1);
        $result = $this->db->get('users');
        return ($result->num_rows() == 1) ? $result->row(0) : false;
    }

    public function checkUserByEmail($email)
    {
        $this->db->where('email', $email);
        $result = $this->db->get('users');
        return ($result->num_rows() == 1) ? $result->row(0) : false;
    }

    public function checkExistingPassword($password)
    {
        $this->db->where('user_id', $this->session->userdata('admin')['user_id']);
        $result = $this->db->get('users');
        return ($result->num_rows() == 1) ? $result->row(0) : false;
    }

    public function saveTokenForPasswordReset($email)
    {
        $token = base64_encode(date('Y-m-d G:i:s')) . appId();
        $this->db->where('email', $email);
        $this->db->update('users', array('token' => $token));
        return $token;
    }

    public function checkIfTokenExist($token)
    {
        $this->db->where('token', $token);
        $query = $this->db->get('users');
        return $query->num_rows() > 0 ? true : false;
    }

    public function updatePasswordByField($field, $value, $password)
    {
        $this->db->where($field, $value);
        $this->db->update('users', array('password' => $password, 'token' => ''));
        $this->session->set_userdata('password', $password);
        return true;
    }

    public function updateProfile($image)
    {
        $data = $this->xssCleanInput();
        if ($image) {
            $data['image'] = $image;
        }
        $this->db->where('user_id', $this->session->userdata('admin')['user_id']);
        return $this->db->update('users', $data);
    }

    public function getUser($column, $value)
    {
        $this->db->where($column, $value);
        $result = $this->db->get('users');
        return ($result->num_rows() == 1) ? $result->row(0) : $this->emptyObject('users');
    }

    public function checkExistingRole($role_id, $user_id)
    {
        $this->db->where('role_id', $role_id);
        $this->db->where('user_id', $user_id);
        $result = $this->db->get('user_roles');
        return ($result->num_rows() > 0) ? true : false;
    }

    public function storeUserRolesBulk()
    {
        $roles = $this->xssCleanInput('roles');
        $user_ids = json_decode($this->xssCleanInput('user_ids'));
        foreach ($roles as $role_id) {
            foreach ($user_ids as $user_id) {
                $existing = $this->checkExistingRole($role_id, $user_id);
                if (!$existing) {
                    $data['user_id'] = $user_id;
                    $data['role_id'] = $role_id;
                    $this->db->insert('user_roles', $data);

                }
            }
        }
    }

    public function storeUser($edit = null, $image = '')
    {
        $data = $this->xssCleanInput();
        $roles = isset($data['roles']) ? $data['roles'] : array();
        unset($data['roles'], $data['user_id']);
        if ($image) {
            $data['image'] = $image;
        }
        if ($edit) {
            $this->db->where('user_id', $edit);
            $data['updated_at'] = date('Y-m-d G:i:s');
            if ($data['password']) {
                $data['password'] = makePassword($this->xssCleanInput('password'));
            } else {
                unset($data['password']);
            }
            $this->db->update('users', $data);
            $this->insertRoles($roles, $edit);
        } else {
            $data['password'] = makePassword($this->xssCleanInput('password'));
            $data['created_at'] = date('Y-m-d G:i:s');
            $data['user_type'] = 'team';
            $data['status'] = 1;
            $this->db->insert('users', $data);
            $id = $this->db->insert_id();
            $this->insertRoles($roles, $id);
            return $id;
        }
    }

    private function insertRoles($data, $id)
    {
        $this->db->delete('user_roles', array('user_id' => $id));
        foreach ($data as $d) {
            $this->db->insert('user_roles', array('user_id' => $id, 'role_id' => $d));
        }
    }

    public function changeStatus($user_id, $status)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update('users', array('status' => ($status == 1 ? 0 : 1)));
    }

    public function remove($user_id)
    {
        $this->db->delete('users', array('user_id' => $user_id));
    }

    public function bulkAction()
    {
        $data = objToArr(json_decode($this->xssCleanInput('data')));
        $action = $data['action'];
        $ids = $data['ids'];
        switch ($action) {
            case "activate":
                $this->db->where_in('user_id', $ids);
                $this->db->update('users', array('status' => 1));
            break;
            case "deactivate":
                $this->db->where_in('user_id', $ids);
                $this->db->update('users', array('status' => '0'));
            break;
        }
    }

    public function valueExist($field, $value, $edit = false)
    {
        $this->db->where($field, $value);
        if ($edit) {
            $this->db->where('user_id !=', $edit);
        }
        $query = $this->db->get('users');
        return $query->num_rows() > 0 ? true : false;
    }

    public function getAll($active = true, $srh = '')
    {
        if ($active) {
            $this->db->where('status', 1);
        }
        if ($srh) {
            $this->db->group_start()->like('username', $srh)->group_end();
        }
        $this->db->where('user_type !=', 'admin');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }

    public function usersList()
    {
        $request = $this->input->post();
        $columns = array(
            "",
            "",
            "users.first_name",
            "users.last_name",
            "users.email",
            "users.username",
            "",
            "users.created_at",
            "users.status",
        );
        $orderColumn = $columns[($request['order'][0]['column'] == 0 ? 5 : $request['order'][0]['column'])];
        $orderDirection = $request['order'][0]['dir'];
        $srh = $request['search']['value'];
        $limit = $request['length'];
        $offset = $request['start'];

        $this->db->from('users');
        $this->db->where('user_type !=', 'admin');
        $this->db->select('
            users.*,
            GROUP_CONCAT('.CF_DB_PREFIX.'roles.title SEPARATOR ", ") as user_roles
        ');
        if ($srh) {
            $this->db->group_start()->like('username', $srh)->or_like('first_name', $srh)
                ->or_like('last_name', $srh)->or_like('email', $srh)->group_end();
        }
        if (isset($request['status']) && $request['status'] != '') {
            $this->db->where('users.status', $request['status']);
        }
        if (isset($request['role']) && $request['role'] != '') {
            $this->db->where('user_roles.role_id', $request['role']);
        }
        $this->db->join('user_roles','user_roles.user_id = users.user_id', 'left');
        $this->db->join('roles','roles.role_id = user_roles.role_id', 'left');
        $this->db->group_by('users.user_id');
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
        $this->db->from('users');
        if ($srh) {
            $this->db->group_start()->like('username', $srh)->or_like('first_name', $srh)
                ->or_like('last_name', $srh)->or_like('email', $srh)->group_end();
        }
        if (isset($request['status']) && $request['status'] != '') {
            $this->db->where('users.status', $request['status']);
        }
        if (isset($request['role']) && $request['role'] != '') {
            $this->db->where('user_roles.role_id', $request['role']);
        }
        $this->db->join('user_roles','user_roles.user_id = users.user_id', 'left');
        $this->db->join('roles','roles.role_id = user_roles.role_id', 'left');
        $this->db->where('user_type !=', 'admin');
        $this->db->group_by('users.user_id');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getRangeTotal($from = '', $to = '')
    {
        $this->db->from('users');
        $this->db->where('created_at >=', $from);
        $this->db->where('created_at <=', $to);
        $this->db->where('user_type !=', 'admin');
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function prepareDataForTable($users)
    {
        $sorted = array();
        foreach ($users as $u) {
            $actions = '';
            $u = objToArr($u);
            if ($u['status'] == 1) {
                $button_text = lang('active');
                $button_class = 'success';
                $button_title = lang('click_to_deactivate');
            } else {
                $button_text = lang('inactive');
                $button_class = 'danger';
                $button_title = lang('click_to_activate');
            }
            if (allowedTo('edit_team_member')) { 
            $actions .= '
                <button type="button" class="btn btn-primary btn-xs create-or-edit-user" data-id="'.$u['user_id'].'"><i class="far fa-edit"></i></button>
            ';
            }
            if (allowedTo('delete_team_member')) { 
            $actions .= '
                <button type="button" class="btn btn-danger btn-xs delete-user" data-id="'.$u['user_id'].'"><i class="far fa-trash-alt"></i></button>
            ';
            }
            $default_image = base_url().'assets/images/not-found.png';
            $sorted[] = array(
                "<input type='checkbox' class='minimal single-check' data-id='".$u['user_id']."' />",
                "<img class='user-thumb-table' src='".userThumb($u['image'])."' onerror='this.src=\"".$default_image."\"'/>",
                esc_output($u['first_name'], 'html'),
                esc_output($u['last_name'], 'html'),
                esc_output($u['email'], 'html'),
                esc_output($u['username'], 'html'),
                esc_output($u['user_roles'], 'html'),
                dateLang($u['created_at']),
                '<button type="button" title="'.$button_title.'" class="btn btn-'.$button_class.' btn-xs change-user-status" data-status="'.$u['status'].'" data-id="'.$u['user_id'].'">'.$button_text.'</button>',
                $actions
            );
        }
        return $sorted;
    }

    public function register($enc_password)
    {
        $data = array(
            'name' => $this->xssCleanInput('name'),
            'email' => $this->xssCleanInput('email'),
            'username' => $this->xssCleanInput('username'),
            'password' => $enc_password,
            'zipcode' => $this->xssCleanInput('zipcode')
        );
        return $this->db->insert('users', $data);
    }

    public function storeRememberMeToken($email, $token)
    {
        $this->db->where('email', $email);
        $this->db->update('users', array('token' => $token));
    }

    public function getUserWithRememberMeToken($token)
    {
        $this->db->where('users.token', $token);
        $this->db->select('users.*');
        $this->db->from($this->table);
        $result = $this->db->get();
        return ($result->num_rows() == 1) ? objToArr($result->row(0)) : array();
    }

    public function storeAdminUser()
    {
        $data = $this->xssCleanInput();
        $data['password'] = makePassword($this->xssCleanInput('password'));
        $data['created_at'] = date('Y-m-d G:i:s');
        $data['user_type'] = 'admin';
        $data['status'] = 1;
        unset($data['retype_password']);
        return $this->db->insert('users', $data);
    }

    public function existingAdminUser()
    {
        $this->db->where('user_type', 'admin');
        $result = $this->db->get('users');
        return ($result->num_rows() > 0) ? true : false;
    }

}