<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class PermissionModel extends Model
{
    protected $table = 'm_permission';
    protected $primaryKey = 'id_permission';
    protected $allowedFields = ['id_role', 'id_menu', 'can_view', 'can_edit', 'can_delete'];

    public function getPermissionsByRole($role_id)
    {
        return $this->select('m_permission.*, m_menu.nama_menu as nama_menu')
            ->join('m_menu', 'm_menu.id_menu = m_permission.id_menu')
            ->where('id_role', $role_id)
            ->findAll();
    }
}
