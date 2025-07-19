<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = 'auth_groups';
    protected $allowedFields = ['id', 'name'];
    protected $useTimestamps  = 'true';

    public function getRole()
    {
        return $this->findAll();
    }
}
