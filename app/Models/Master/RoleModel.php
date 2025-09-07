<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = 'm_role';
    protected $allowedFields = ['id', 'name'];
    protected $useTimestamps  = 'true';

    public function getRole()
    {
        return $this->findAll();
    }
}
