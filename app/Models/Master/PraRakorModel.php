<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class PraRakorModel extends Model
{
    protected $table = 'trx_prog_tahunan_pra_rakorbangwil';
    protected $useTimestamps = true;

    public function getProgram()
    {
        $builder = $this->db->table('trx_prog_tahunan_pra_rakorbangwil as a');
        $builder->join('trx_prog_tahunan_pra_rakorbangwil as b', 'a.id_pn = b.id_pn', 'left');
        $builder->join('m_kl as c', 'b.id_kl = c.id_kl', 'left');
        $builder->select(' c.nama_kl ,c.short_kl , b.id_pn');
        $query = $builder->get();
        return $query->getResult();
    }
    public function getCatatan($id)
    {
        $builder = $this->db->table('prog_tahunan_pra_rakorbangwil as b');
        $builder->select(' b.*');
        $builder->where('b.id_pn', $id);

        $query = $builder->get();
        return $query->getFirstRow();
    }
}
