<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class TematikModel extends Model
{
    protected $table = 'm_tematik';

    public function getTematik()
    {
        $builder = $this->db->table('m_tematik');
        $builder->select('m_tematik.*');
        $builder->orderBy('id_tematik', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }
}
