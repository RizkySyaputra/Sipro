<?php

namespace App\Models\Rakorbangwil;

use CodeIgniter\Model;

class ReportProgTahunanPerProvinsiPerPNModel extends Model
{

    protected $allowedFields    = [
        'thn_pelaksanaan',
        'id_provinsi',
        'provinsi',
        'kawasan',
        'pn0_kawasan',
        'pn2_kawasan',
        'pn3_kawasan',
        'pn4_kawasan',
        'pn5_kawasan',
        'pn6_kawasan',
        'pn8_kawasan',
        'tematik',
        'pn0_tematik',
        'pn2_tematik',
        'pn3_tematik',
        'pn4_tematik',
        'pn5_tematik',
        'pn6_tematik',
        'pn8_tematik',
        'pekerjaan',
        'pn0_pekerjaan',
        'pn2_pekerjaan',
        'pn3_pekerjaan',
        'pn4_pekerjaan',
        'pn5_pekerjaan',
        'pn6_pekerjaan',
        'pn8_pekerjaan',
        'anggaran',
        'pn0_anggaran',
        'pn2_anggaran',
        'pn3_anggaran',
        'pn4_anggaran',
        'pn5_anggaran',
        'pn6_anggaran',
        'pn8_anggaran',
        'source_data'
    ];

    // protected $useTimestamps = true;
    // protected $createdField  = 'created_at';  // pastikan ada di tabel
    // protected $updatedField  = 'updated_at';  // pastikan ada di tabel


    public function getReportKawasanPerProvinsiPerPN($tahun_pelaksanaan = null, $id_provinsi = null)
    {
        $builder = $this->db->table('view_prog_tahunan_lap_pn_ktpa');

        $builder->select("provinsi, kawasan, pn2_kawasan, pn3_kawasan, pn4_kawasan, pn5_kawasan, pn6_kawasan, pn8_kawasan, tematik, pn2_tematik, pn3_tematik, pn4_tematik, pn5_tematik, pn6_tematik, pn8_tematik, pekerjaan, pn2_pekerjaan,
        pn3_pekerjaan, pn4_pekerjaan, pn5_pekerjaan, pn6_pekerjaan, pn8_pekerjaan, (anggaran - pn0_anggaran) as total_anggaran, pn2_anggaran, pn3_anggaran, pn4_anggaran, pn5_anggaran, pn6_anggaran, pn8_anggaran");
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
