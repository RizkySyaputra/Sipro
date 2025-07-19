<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class PendanaanModel extends Model
{
    protected $table = 'm_pendanaan';
    protected $allowedFields = ['id', 'sumber_pendanaan'];
    protected $useTimestamps  = 'true';

    public function getPendanaan()
    {
        return $this->findAll();
    }
}
