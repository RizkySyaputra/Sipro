<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['id_user', 'username', 'id_role'];
    protected $useTimestamps  = 'true';
    protected $primaryKey = 'id_user';

    public function getUser()
    {
        $builder = $this->db->table('users as users');
        $builder->select('users.*, m_role.*');
        $builder->join('m_role', 'users.id_role = m_role.id_role', 'left');
        $query = $builder->get();
        return $query->getResult();
    }

    public function editrole($user_id, $role_id)
    {
        $builder = $this->db->table('users');
        $builder->where('id_user', $user_id);
        $builder->update(['id_role' => $role_id]);

        return $this->db->affectedRows();
        // 1 = ada row ter-update, 0 = tidak ada perubahan
    }
}
