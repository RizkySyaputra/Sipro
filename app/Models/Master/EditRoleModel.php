<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class EditRoleModel extends Model
{
    protected $table = 'auth_groups_users';
    protected $allowedFields = ['group_id', 'user_id'];
    protected $useTimestamps  = 'true';

    public function editrole($id, $role_id)
    {
        $builder = $this->db->table('auth_groups_users');
        $data = [
            'group_id' => $role_id
        ];
        $builder->where('user_id', $id);
        $builder->update($data);

        return $this->db->affectedRows() > 0; // Mengembalikan true jika ada perubahan
    }
}
