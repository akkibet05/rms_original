<?php

class AdminRoleModel extends CI_Model
{
    protected $table = 'roles';
    protected $key = 'role_id';

    public function storeRole($edit = null)
    {
        $data = $this->xssCleanInput();
        if ($edit) {
            $this->db->where('role_id', $edit);
            $data['updated_at'] = date('Y-m-d G:i:s');
            $this->db->update('roles', $data);
        } else {
            $data['created_at'] = date('Y-m-d G:i:s');
            $this->db->insert('roles', $data);
            $id = $this->db->insert_id();
            return array('id' => $id, 'title' => $data['title']);
        }
    }

    public function remove($role_id)
    {
        $this->db->delete('roles', array('role_id' => $role_id));
        $this->db->delete('role_permissions', array('role_id' => $role_id));
    }

    public function valueExist($field, $value, $edit = false)
    {
        $this->db->where($field, $value);
        $this->db->where('account_id', '(NULL)');
        if ($edit) {
            $this->db->where('role_id !=', $edit);
        }
        $query = $this->db->get('roles');
        return $query->num_rows() > 0 ? true : false;
    }

    public function getAll()
    {
        $this->db->select('
            roles.*,
            COUNT(DISTINCT('.CF_DB_PREFIX.'role_permissions.permission_id)) as permissions_count
        ');
        $this->db->from($this->table);
        $this->db->join('role_permissions','role_permissions.role_id = roles.role_id', 'left');
        $this->db->group_by('roles.role_id');
        $this->db->order_by('roles.created_at', 'DESC');
        $query = $this->db->get();
        return objToArr($query->result());
    }

    public function getUserRoles($user_id)
    {
        $this->db->select('
            GROUP_CONCAT('.CF_DB_PREFIX.'user_roles.role_id) AS role_ids,
        ');
        $this->db->from('user_roles');
        $this->db->join('roles', 'roles.role_id = user_roles.role_id', 'left');
        $this->db->where('user_roles.user_id', $user_id);
        $this->db->group_by('user_roles.user_id');
        $query = $this->db->get();
        $result = $query->result();
        return isset($result[0]->role_ids) ? $result[0]->role_ids : '';
    }

    public function getPermissions($role_id)
    {
        $role_id = $role_id ? $role_id : 0;
        $this->db->select('
            permissions.*,
            ('.CF_DB_PREFIX.'role_permissions.permission_id IS NOT NULL) AS selected
        ');
        $this->db->from('permissions');
        $this->db->join(
            'role_permissions', 
            'role_permissions.permission_id = permissions.permission_id AND role_permissions.role_id = '.$role_id, 
            'left'
        );
        $this->db->group_by('permissions.permission_id');
        $query = $this->db->get();
        $permissions = $query->result();
        $sorted = array();
        foreach ($permissions as $key => $value) {
            $sorted[$value->category][] = array(
                'id' => $value->permission_id, 
                'title' => $value->title,
                'selected' => $value->selected,
                'slug' => $value->slug
            );
        }
        return $sorted;
    }

    public function addPermission($role_id, $permission_id)
    {
        $permission_id = explode(',', $permission_id);
        foreach ($permission_id as $p_id) {
            $data['role_id'] = $role_id;
            $data['permission_id'] = $p_id;
            $this->db->insert('role_permissions', $data);
        }
    }

    public function removePermission($role_id, $permission_id)
    {
        $permission_id = explode(',', $permission_id);
        foreach ($permission_id as $p_id) {
            $this->db->delete('role_permissions', array('role_id' => $role_id, 'permission_id' => $p_id));
        }
    }

    public function getUserPermissions($user_id)
    {
        $user_roles = $this->getUserRoles($user_id);
        $role_ids = explode(',', $user_roles);
        $permission_ids = $this->getPermissionIds($role_ids);
        $this->db->select('permissions.slug');
        $this->db->from('permissions');
        $this->db->where_in('permissions.permission_id', explode(',', $permission_ids));
        $this->db->group_by('permissions.permission_id');
        $query = $this->db->get();
        $result = $query->result();
        $permissions = array();
        foreach ($result as $value) {
            $permissions[] = $value->slug;
        }
        return $permissions;
    }

    public function getPermissionIds($role_ids)
    {
        $this->db->select('
            GROUP_CONCAT(DISTINCT('.CF_DB_PREFIX.'role_permissions.permission_id)) AS permissions,
        ');
        $this->db->from('role_permissions');
        $this->db->where_in('role_permissions.role_id', $role_ids);
        $query = $this->db->get();
        $result = $query->result();
        return isset($result[0]->permissions) ? $result[0]->permissions : 0;

    }
}