<?php

namespace App\Models\Rakorbangwil;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class KebutuhanKLModel extends Model
{
    protected $table = 'prog_tahunan_kebutuhan_kl';

    protected $cache;
    protected $useTimestamps = true;
    public function getKebutuhanKl($id_pn)
    {
        $builder = $this->db->table('prog_tahunan_kebutuhan_kl as a');
        $builder->select('*');
        $builder->join('m_kl b', 'a.id_kl = b.id_kl', 'left');
        $builder->where('a.id_pn', $id_pn);
        $builder->where('a.id_pn', $id_pn);
        $builder->orderBy('a.id_kl', 'ASC');
        $builder->orderBy('a.puswil', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }
}
