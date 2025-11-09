<?php

namespace App\Models\Rakorbangwil;

use CodeIgniter\Model;

class ReportProgTahunanPerProvinsiPerUnorModel extends Model
{

    protected $allowedFields    = [
        'thn_pelaksanaan',
        'id_provinsi',
        'provinsi',
        'kawasan',
        'sda_kawasan',
        'bm_kawasan',
        'ck_kawasan',
        'ps_kawasan',
        'tematik',
        'sda_tematik',
        'bm_tematik',
        'ck_tematik',
        'ps_tematik',
        'pekerjaan',
        'sda_pekerjaan',
        'bm_pekerjaan',
        'ck_pekerjaan',
        'ps_pekerjaan',
        'anggaran',
        'sda_anggaran',
        'bm_anggaran',
        'ck_anggaran',
        'ps_anggaran',
        'source_data'
    ];

    // protected $useTimestamps = true;
    // protected $createdField  = 'created_at';  // pastikan ada di tabel
    // protected $updatedField  = 'updated_at';  // pastikan ada di tabel


    public function getReportKawasanPerProvinsiPerUnor($tahun_pelaksanaan = null, $id_provinsi)
    {
        $builder = $this->db->table('view_prog_tahunan_unor_ktpa');

        $builder->select("provinsi, kawasan, sda_kawasan, bm_kawasan, ck_kawasan, ps_kawasan, tematik, sda_tematik, bm_tematik, ck_tematik, ps_tematik, pekerjaan, sda_pekerjaan, bm_pekerjaan, ck_pekerjaan, ps_pekerjaan, anggaran, sda_anggaran, bm_anggaran, ck_anggaran, ps_anggaran,");
        $builder->where('thn_pelaksanaan', "$tahun_pelaksanaan");
        if (!empty($id_provinsi)) {
            $builder->where('id_provinsi', "$id_provinsi");
        }
        $builder->groupBy('provinsi');
        $builder->orderBy('id_provinsi');
        $query = $builder->get();
        return $query->getResult();
        // echo $builder->getCompiledSelect();
        // echo $this->db->getLastQuery();
        // exit;
    }
}
