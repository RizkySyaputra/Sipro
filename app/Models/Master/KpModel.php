<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class KpModel extends Model
{
    protected $table = 'k_kp';
    protected $allowedFields = ['kolom1', 'kolom2']; // ganti dengan kolom yang sesuai
    protected $useTimestamps = true;

    public function getAll()
    {
        return $this->findAll();
    }
}
