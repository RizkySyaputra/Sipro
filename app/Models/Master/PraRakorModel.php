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
    public function getKawasanList($id_provinsi = null, $id_tematik, $id_pn)
    {
        $builder = $this->db->table('prog_tahunan as a');
        $builder->select('DISTINCT(c.nama_kawasan) as kawasan');
        $builder->join('prog_tahunan_kwsn as b', 'a.id_prog_tahunan = b.id_prog_tahunan', 'left');
        $builder->join('m_kawasan as c', 'b.id_kawasan = c.kode_kawasan', 'left');
        $builder->join('m_tematik as d', 'c.id_tematik_kawasan = d.id_tematik', 'left');
        $builder->join('m_sk_ro as e', 'e.id_ro = a.id_ro', 'inner');
        $builder->where('a.id_provinsi', $id_provinsi);
        $builder->where('d.id_tematik', $id_tematik);
        $builder->where('e.id_pn', $id_pn);
        $builder->orderBy('c.kode_kawasan', 'ASC');

        $query = $builder->get();
        return $query->getResult();
    }
    public function getProgramList($id_provinsi = null, $id_tematik, $id_pn)
    {
        $builder = $this->db->table('prog_tahunan as a');
        $builder->select('*');
        $builder->join('prog_tahunan_kwsn as b', 'a.id_prog_tahunan = b.id_prog_tahunan', 'left');
        $builder->join('m_kawasan as c', 'b.id_kawasan = c.kode_kawasan', 'left');
        $builder->join('m_tematik as d', 'c.id_tematik_kawasan = d.id_tematik', 'left');
        $builder->join('m_unor as e', 'a.id_unor = e.id_2', 'left');
        $builder->join('m_satuan as f', 'a.id_satuan = f.id_satuan', 'left');
        $builder->join('m_sk_ro as g', 'g.id_ro = a.id_ro', 'inner');
        $builder->where('a.id_provinsi', $id_provinsi);
        $builder->where('d.id_tematik', $id_tematik);
        $builder->where('g.id_pn', $id_pn);
        $builder->orderBy('c.kode_kawasan', 'ASC');

        $query = $builder->get();
        return $query->getResult();
    }
}
