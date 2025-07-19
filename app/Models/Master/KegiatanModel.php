<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class KegiatanModel extends Model
{
    protected $table = 'm_kegiatan';
    protected $allowedFields = ['kdgiat', 'nmgiat', 'tahun', 'id_unor'];
    protected $useTimestamps  = 'true';

    public function getKegiatan()
    {
        return $this->findAll();
    }
}
