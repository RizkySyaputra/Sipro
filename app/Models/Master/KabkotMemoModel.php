<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class KabkotMemoModel extends Model
{
    protected $table = 'prog_memorandum_kabkot';

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = [
        'id',
        'id_memorandum',
        'id_kabkot'
    ];

    public function getKabkotMemo($id_memorandum)
    {
        $builder = $this->db->table('prog_memorandum_kabkot as a');
        $builder->join('m_kabkot as b', 'a.id_kabkot = b.id', 'left');
        $builder->select('b.kab_kot, a.id_kabkot');
        $builder->where('a.id_memorandum', $id_memorandum);
        $query = $builder->get();
        return $query->getResult();
    }
}
