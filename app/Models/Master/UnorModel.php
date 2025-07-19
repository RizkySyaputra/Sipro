<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class UnorModel extends Model
{
    protected $table = 'm_unor';
    protected $allowedFields = ['id', 'unor', 'short'];
    protected $useTimestamps  = 'true';

    public function getUnor()
    {
        $builder = $this->db->table('m_unor');
        $builder->select('m_unor.*');
        $builder->whereIn('id', ['06', '04', '05', '08']);
        // $builder->orderBy('id', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }
}
