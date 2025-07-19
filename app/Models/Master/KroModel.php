<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class KroModel extends Model
{
    protected $table = 'm_kro';
    protected $allowedFields = ['kdkro', 'nmkro', 'tahun'];
    protected $useTimestamps  = 'true';

    public function getKro()
    {
        return $this->findAll();
    }
}
