<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class SatuanModel extends Model
{
    protected $table = 'm_satuan';
    protected $allowedFields = ['id_satuan', 'nama_satuan'];
    protected $useTimestamps  = 'true';

    public function getSatuan()
    {
        $this->orderBy('nama_satuan', 'ASC');
        return $this->findAll();
    }
}
