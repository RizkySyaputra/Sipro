<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class KegiatanModel extends Model
{
    protected $table = 'm_sk_kegiatan';
    protected $allowedFields = ['id_program', 'id_kegiatan', 'nm_kegiatan', 'periode'];
    protected $useTimestamps  = 'true';

    public function getKegiatan()
    {
        return $this->findAll();
    }
}
