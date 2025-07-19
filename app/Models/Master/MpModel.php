<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class MpModel extends Model
{
    protected $table = 'm_mp';
    protected $allowedFields = ['id_mp', 'nama_mp'];
    protected $useTimestamps  = 'true';

    public function getMp()
    {
        return $this->findAll();
    }
}
