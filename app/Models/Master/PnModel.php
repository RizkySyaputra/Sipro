<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class PnModel extends Model
{
    protected $table = 'k_pn';
    protected $useTimestamps = true;

    public function getAll()
    {
        return $this->findAll();
    }
}
