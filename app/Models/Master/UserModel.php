<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['id', 'username', 'id_role'];
    protected $useTimestamps  = 'true';
    protected $primaryKey = 'id';

    public function getUser()
    {
        $builder = $this->db->table('users as users');
        $builder->select('users.id as id_user, users.username, users.id_role, m_role.*');
        $builder->join('m_role', 'users.id_role = m_role.id', 'left');
        $builder->orderBy('users.id');
        $query = $builder->get();
        return $query->getResult();
    }

    public function editrole($user_id, $role_id)
    {
        $builder = $this->db->table('users');
        $builder->where('id', $user_id);
        $builder->update(['id_role' => $role_id]);

        return $this->db->affectedRows();
        // 1 = ada row ter-update, 0 = tidak ada perubahan
    }
}
