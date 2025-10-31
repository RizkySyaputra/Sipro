<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class KabkotProgTahunanModel extends Model
{
    protected $table = 'prog_tahunan_kabkot';

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = [
        'id',
        'id_prog_tahunan',
        'id_kabkot'
    ];

    public function getKabkotProgTahunan($id_prog_tahunan)
    {
        $builder = $this->db->table('prog_tahunan_kabkot as a');
        $builder->join('m_kabkot as b', 'a.id_kabkot = b.id', 'left');
        $builder->select('b.kab_kot, a.id_kabkot');
        $builder->where('a.id_prog_tahunan', $id_prog_tahunan);
        $query = $builder->get();
        return $query->getResult();
    }
}
