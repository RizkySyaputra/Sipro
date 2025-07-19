<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class RoModel extends Model
{
    protected $table = 'm_ro';
    protected $allowedFields = ['kdro', 'nmro', 'tahun'];
    protected $useTimestamps  = 'true';

    public function getRo()
    {
        return $this->findAll();
    }
}
