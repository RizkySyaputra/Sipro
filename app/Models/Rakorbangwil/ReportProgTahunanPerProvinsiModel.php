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


    public function getReportKawasanPerProvinsi($tahun_pelaksanaan = null, $id_provinsi = null, $id_unor = null, $id_pn = null)
    {
        // $builder = $this->db->table('view_prog_tahunan_lap_ktpa');

        // $builder->select("provinsi, kawasan, tematik, pekerjaan, anggaran");
        // $builder->where('thn_pelaksanaan', "$tahun_pelaksanaan");
        // if (!empty($id_provinsi)) {
        //     $builder->where('id_provinsi', "$id_provinsi");
        // }
        // $builder->groupBy('provinsi');
        // $builder->orderBy('id_provinsi');
        // $query = $builder->get();
        // return $query->getResult();
        // echo $builder->getCompiledSelect();
        // echo $this->db->getLastQuery();

        $builder = $this->db->table('sipro_kp.trx_prog_tahunan_kt');

        // $builder->select('provinsi, COUNT(DISTINCT kawasan) as jml_kawasan');
        // $builder->selectSum("CASE WHEN tematik = 'Kawasan Pertumbuhan' THEN 1 ELSE 0 END", 'jml_pertumbuhan', false);
        // $builder->selectSum("CASE WHEN tematik = 'Kawasan Afirmasi' THEN 1 ELSE 0 END", 'jml_afirmasi', false);
        // $builder->selectSum("CASE WHEN tematik = 'Kawasan Konservasi/Rawan Bencana' THEN 1 ELSE 0 END", 'jml_konservasi', false);
        // $builder->selectSum("CASE WHEN tematik = 'Kawasan Komoditas Unggulan' THEN 1 ELSE 0 END", 'jml_unggulan', false);
        // $builder->selectSum("CASE WHEN tematik = 'Kawasan Swasembada Pangan Air dan Energi' THEN 1 ELSE 0 END", 'jml_swasembada', false);

        $builder->select("provinsi, count(distinct kawasan) as jml_kawasan,
        CASE 
            WHEN COUNT(DISTINCT CASE WHEN tematik = 'Kawasan Pertumbuhan' THEN kawasan END) > 0 
            THEN 1 ELSE 0 
        END AS jml_pertumbuhan,

        CASE 
            WHEN COUNT(DISTINCT CASE WHEN tematik = 'Kawasan Afirmasi' THEN kawasan END) > 0 
            THEN 1 ELSE 0 
        END AS jml_afirmasi,

        CASE 
            WHEN COUNT(DISTINCT CASE WHEN tematik = 'Kawasan Konservasi/Rawan Bencana' THEN kawasan END) > 0 
            THEN 1 ELSE 0 
        END AS jml_konservasi,

        CASE 
            WHEN COUNT(DISTINCT CASE WHEN tematik = 'Kawasan Komoditas Unggulan' THEN kawasan END) > 0 
            THEN 1 ELSE 0 
        END AS jml_unggulan,

        CASE 
            WHEN COUNT(DISTINCT CASE WHEN tematik = 'Kawasan Swasembada Pangan Air dan Energi' THEN kawasan END) > 0 
            THEN 1 ELSE 0 
        END AS jml_swasembada

        ", false);


        $builder->where('thn_pelaksanaan', "$tahun_pelaksanaan");

        if (!empty($id_provinsi)) {
            $builder->whereIn('id_provinsi', $id_provinsi);
        }
        if (!empty($id_unor)) {
            $builder->where('id_unor', $id_unor);
        }
        if ($id_pn !== null && $id_pn !== '') {
            if ($id_pn == 28) {
                $builder->whereIn('id_pn', [2, 3, 4, 5, 6, 8]);
            } else {
                $builder->where('id_pn', $id_pn);
            }
        }
        $builder->groupBy('provinsi');
        $builder->orderBy('id_provinsi');

        // echo $builder->getCompiledSelect();
        // exit;

        $query = $builder->get();
        return $query->getResult();
    }

    public function getReportAnggaranPerProvinsi($tahun_pelaksanaan = null, $id_provinsi = null, $id_unor = null, $id_pn = null)
    {
        // $builder = $this->db->table('view_prog_tahunan_lap_ktpa');

        // $builder->select("provinsi, anggaran, rpm, phln, sbsn, (rpm + phln + sbsn) as total_apbn, other");
        // $builder->where('thn_pelaksanaan', "$tahun_pelaksanaan");
        // if (!empty($id_provinsi)) {
        //     $builder->where('id_provinsi', "$id_provinsi");
        // }
        // $builder->groupBy('provinsi');
        // $builder->orderBy('id_provinsi');
        // $query = $builder->get();
        // return $query->getResult();

        $builder = $this->db->table('trx_prog_tahunan_pa');

        $builder->select("provinsi, SUM(pekerjaan) as total_pekerjaan, SUM(pkrjn_rpm) as total_pkrjn_rpm, SUM(pkrjn_phln) as total_pkrjn_phln, SUM(pkrjn_sbsn) as total_pkrjn_sbsn, (SUM(pkrjn_rpm) + SUM(pkrjn_phln) + SUM(pkrjn_sbsn)) as total_pkrjn_apbn, SUM(pkrjn_other) as total_pkrjn_other, SUM(anggaran) as total_anggaran, SUM(rpm) as total_rpm, SUM(phln) as total_phln, SUM(sbsn) as total_sbsn, (SUM(rpm) + SUM(phln) + SUM(sbsn)) as total_apbn, SUM(other) as total_other");
        $builder->where('thn_pelaksanaan', "$tahun_pelaksanaan");

        if (!empty($id_provinsi)) {
            $builder->whereIn('id_provinsi', $id_provinsi);
        }
        if (!empty($id_unor)) {
            $builder->where('id_unor', $id_unor);
        }
        if ($id_pn !== null && $id_pn !== '') {
            if ($id_pn == 28) {
                $builder->whereIn('id_pn', [2, 3, 4, 5, 6, 8]);
            } else {
                $builder->where('id_pn', $id_pn);
            }
        }
        $builder->groupBy('provinsi');
        $builder->orderBy('id_provinsi');

        // echo $builder->getCompiledSelect();
        // exit;

        $query = $builder->get();
        return $query->getResult();
    }
}
