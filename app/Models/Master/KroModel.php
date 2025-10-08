<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class KroModel extends Model
{
    protected $table = 'm_sk_kro';
    protected $allowedFields = ['id_program', 'id_kegiatan', 'id_kro', 'nm_kro', 'periode'];
    protected $useTimestamps  = 'true';

    // public function getKro()
    // {
    //     return $this->findAll();
    // }

    public function getKro($id_kegiatan)
    {
        $builder = $this->db->table('m_sk_kro as mskro');
        $builder->select('mskro.id_kro, mskro.nm_kro');
        $builder->where('mskro.id_kegiatan', $id_kegiatan);
        $query = $builder->get();
        return $query->getResult();
    }
}
