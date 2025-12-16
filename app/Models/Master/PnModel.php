<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class PnModel extends Model
{
    protected $table = 'm_rpjmn_pn';
    protected $primaryKey = 'id_pn';
    protected $useTimestamps = true;

    public function getAll()
    {
        return $this->findAll();
    }

    public function getKl()
    {
        $builder = $this->db->table('m_rpjmn_pn as a');
        $builder->join('m_kl_pn as b', 'a.id_pn = b.id_pn', 'left');
        $builder->join('m_kl as c', 'b.id_kl = c.id_kl', 'left');
        $builder->select(' c.nama_kl ,c.short_kl , b.id_pn');
        $builder->orderBy('b.id_pn', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }
}
