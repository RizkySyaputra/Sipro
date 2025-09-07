<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'm_menu';
    protected $allowedFields = ['id_menu', 'nama_menu', 'parent_id', 'link', 'level', 'id_tipe', 'tipe', 'is_active'];
    protected $useTimestamps  = 'true';
    // public function getMenubyParent($parent_id)
    // {
    //     $builder = $this->db->table('m_menu as menu');
    //     $builder->select('menu.*');
    //     $builder->where('parent_id', $parent_id);
    //     $query = $builder->get();
    //     return $query->getResult();
    // }
    // public function getMenubyRole()
    // {
    //     $builder = $this->db->table('users as users');
    //     $builder->select('users.*,  auth_groups_users.*, auth_groups.*');
    //     $builder->join('auth_groups_users', 'users.id = auth_groups_users.user_id', 'left');
    //     $builder->join('auth_groups', 'auth_groups_users.group_id = auth_groups.id', 'left');
    //     $query = $builder->get();
    //     return $query->getResult();
    // }
}
