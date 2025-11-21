<?php

namespace App\Models\Rakorbangwil;

use CodeIgniter\Model;

class DaftarProgTahunanModel extends Model
{
    protected $table = 'view_prog_tahunan';
    protected $primaryKey = 'id_prog_tahunan';
    protected $returnType = 'object';


    public function getDaftarProgramTahunan($id_provinsi, $id_unor, $sumber, $pn)
    {
        $tahun_pelaksanaan = session('tahun_pelaksana');
        $builder = $this->db->table('view_prog_tahunan as a');

        // SELECT clause
        $builder->select("a.*");
        // WHERE clause
        if ($id_provinsi) {
            $builder->where('a.id_provinsi', $id_provinsi);
        }
        if ($id_unor) {
            $builder->where('a.id_unor', $id_unor);
        }
        if ($sumber) {
            $builder->where('a.sumber', $sumber);
        }
        if ($pn == "NON") {
            $builder->where('a.id_pn', null);
        } elseif ($pn == "ALL") {
        } else {
            $builder->where('a.id_pn', $pn);
        }
        $builder->where('a.thn_pelaksanaan', $tahun_pelaksanaan);
        $builder->orderBy('a.id_prog_tahunan', 'ASC');

        // Eksekusi
        $query = $builder->get();
        return $query->getResult();
    }
}
