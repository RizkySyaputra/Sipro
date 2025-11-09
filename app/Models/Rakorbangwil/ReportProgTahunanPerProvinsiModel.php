<?php

namespace App\Models\Rakorbangwil;

use CodeIgniter\Model;

class ReportProgTahunanPerProvinsiModel extends Model
{

    protected $allowedFields    = [
        'thn_pelaksanaan',
        'id_provinsi',
        'provinsi',
        'kawasan',
        'tematik',
        'pekerjaan',
        'anggaran',
        'rpm',
        'phln',
        'sbsn',
        'other',
        'source_data'
    ];

    // protected $useTimestamps = true;
    // protected $createdField  = 'created_at';  // pastikan ada di tabel
    // protected $updatedField  = 'updated_at';  // pastikan ada di tabel


    public function getReportKawasanPerProvinsi($tahun_pelaksanaan = null, $id_provinsi = null)
    {
        $builder = $this->db->table('view_prog_tahunan_lap_ktpa');

        $builder->select("provinsi, kawasan, tematik, pekerjaan, anggaran");
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
    }

    public function getReportAnggaranPerProvinsi($tahun_pelaksanaan = null, $id_provinsi = null)
    {
        $builder = $this->db->table('view_prog_tahunan_lap_ktpa');

        $builder->select("provinsi, anggaran, rpm, phln, sbsn, (rpm + phln + sbsn) as total_apbn, other");
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
    }
}
