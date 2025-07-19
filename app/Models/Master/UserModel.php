<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['id_user', 'username', 'name'];
    protected $useTimestamps  = 'true';

    public function getUser()
    {
        $builder = $this->db->table('users as users');
        $builder->select('users.*,  auth_groups_users.*, auth_groups.*');
        $builder->join('auth_groups_users', 'users.id = auth_groups_users.user_id', 'left');
        $builder->join('auth_groups', 'auth_groups_users.group_id = auth_groups.id', 'left');
        $query = $builder->get();
        return $query->getResult();
    }
}
