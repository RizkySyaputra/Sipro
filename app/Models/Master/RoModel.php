<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class RoModel extends Model
{
    protected $table = 'm_sk_ro';
    protected $allowedFields = ['id_program', 'id_kegiatan', 'id_kro', 'id_ro',  'nm_ro', 'periode'];
    protected $useTimestamps  = 'true';

    // public function getRo()
    // {
    //     return $this->findAll();
    // }

    public function getRo($id_kro)
    {
        $builder = $this->db->table('m_sk_ro as msro');
        $builder->select('msro.id_ro, msro.nm_ro');
        $builder->where('msro.id_kro', $id_kro);
        $query = $builder->get();
        return $query->getResult();
    }
}
