<?php

namespace App\Models\Rakorbangwil;

use CodeIgniter\Model;

class ReportProgTahunanModel extends Model
{
    protected $table            = 'prog_tahunan';
    protected $primaryKey       = 'id_prog_tahunan';   // asumsi primary key ini
    protected $useAutoIncrement = false;

    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'id_renaksi',
        'id_memorandum',
        'id_program',
        'id_kegiatan',
        'id_kro',
        'id_ro',
        'id_provinsi',
        'id_unor',
        'pekerjaan',
        'lokasi',
        'justifikasi',
        'id_satuan',
        'volume',
        'id_pendanaan',
        'anggaran',
        'geotag',
        'geotag_uraian',
        'catatan_memorandum',
        'sumber',
        'thn_pelaksanaan',
        'kebutuhan_dukungan_kl',
        'reviu_puswil'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';  // pastikan ada di tabel
    protected $updatedField  = 'updated_at';  // pastikan ada di tabel


    public function getReportKawasanPerProvinsi($tahun_anggaran = null)
    {
        $builder = $this->db->table('view_prog_tahunan_lap_ktpa');

        $builder->select("provinsi, sum(kawasan) as jumlah_kawasan, sum(tematik) as jumlah_tematik, sum(pekerjaan) as jumlah_pekerjaan");

        $builder->groupBy('provinsi');
        $builder->orderBy('id');
        $query = $builder->get();
        // echo $builder->getCompiledSelect();
        // echo $this->db->getLastQuery();
        return $query->getResult();
    }
}
