<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class KroModel extends Model
{
    protected $table = 'm_sk_kro';
    protected $allowedFields = ['id_program', 'id_kegiatan', 'id_kro', 'nm_kro', 'periode'];
    protected $useTimestamps  = 'true';

    public function getKro()
    {
        return $this->findAll();
    }
}
