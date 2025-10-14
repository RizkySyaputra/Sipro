<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class RoModel extends Model
{
    protected $table = 'm_sk_ro';
    protected $allowedFields =  ['id_program', 'id_kegiatan', 'id_kro', 'id_ro', 'nm_ro', 'id_satuan', 'periode'];
    protected $useTimestamps  = 'true';

    public function getRo()
    {
        return $this->findAll();
    }
}
