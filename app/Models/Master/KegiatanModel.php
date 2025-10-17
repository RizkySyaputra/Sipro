<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class KegiatanModel extends Model
{
    protected $table = 'm_sk_kegiatan';
    protected $allowedFields = ['id_program', 'id_kegiatan', 'nm_kegiatan', 'periode'];
    protected $useTimestamps  = 'true';

    // public function getKegiatan($id_program)
    // {
    //     return $this->findAll();

    // }

    public function getKegiatan($id_program)
    {
        $builder = $this->db->table('m_sk_kegiatan as msk');
        $builder->select('msk.id_kegiatan, msk.nm_kegiatan');
        $builder->where('msk.id_program', $id_program);
        $query = $builder->get();
        return $query->getResult();
    }
}
