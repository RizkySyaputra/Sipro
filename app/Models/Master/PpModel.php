<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class PpModel extends Model
{
    protected $table = 'k_pp';
    protected $useTimestamps = true;

    public function getAll()
    {
        return $this->findAll();
    }
}
