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
        $builder = $this->db->table('sipro_kp.trx_prog_tahunan_kt');

        $builder->select(
            "provinsi, 
            COUNT(DISTINCT(IF(id_kawasan!=0,id_kawasan,NULL))) AS jml_kawasan,
            COUNT(DISTINCT(IF(id_tematik='1',id_kawasan,NULL))) AS jml_afirmasi,
            COUNT(DISTINCT(IF(id_tematik='2',id_kawasan,NULL))) AS jml_unggulan,
            COUNT(DISTINCT(IF(id_tematik='3',id_kawasan,NULL))) AS jml_konservasi,
            COUNT(DISTINCT(IF(id_tematik='4',id_kawasan,NULL))) AS jml_pertumbuhan,
            COUNT(DISTINCT(IF(id_tematik='5',id_kawasan,NULL))) AS jml_swasembada"
        );

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
        $builder->groupBy('id_provinsi');
        $builder->orderBy('id_provinsi');

        // echo $builder->getCompiledSelect();
        // exit;

        $query = $builder->get();
        return $query->getResult();
    }

    public function getReportAnggaranPerProvinsi($tahun_pelaksanaan = null, $id_provinsi = null, $id_unor = null, $id_pn = null)
    {
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

    public function getReportDeskRakorbangwilKawasanPekerjaan($id_provinsi, $pn = "ALL", $catatan_kl = null, $pembiayaan = null)
    {
        $tahun_pelaksanaan = session('tahun_pelaksana');
        $builder = $this->db->table('view_prog_tahunan as a');
        // SELECT clause
        $builder->select("a.*");
        // WHERE clause
        if ($id_provinsi) {
            $builder->whereIn('a.id_provinsi', $id_provinsi);
        }
        // if ($id_unor) {
        //     $builder->where('a.id_unor', $id_unor);
        // }
        // if ($sumber) {
        //     $builder->where('a.sumber', $sumber);
        // }

        if ($pembiayaan) {
            if ($pembiayaan == 'x') {
                $builder->whereIn('a.id_pendanaan', [1, 3, 5, 6, 7]);
            } else {
                $builder->where('a.id_pendanaan', $pembiayaan);
            }
        }
        if ($pn) {
            if ($pn == "ALLPN") {
                $builder->where('a.id_pn is not null', null, false);
            } else {
                $builder->where('a.id_pn', $pn);
            }
        }

        if ($catatan_kl == 'x') {
            $builder->groupStart() // buka grup OR
                ->groupStart()
                ->where('a.catatan_pra_rakorbangwil IS NOT NULL', null, false)
                ->where('a.catatan_pra_rakorbangwil !=', '-')
                ->groupEnd()
                ->orGroupStart()
                ->where('a.catatan_konfrm_pemda IS NOT NULL', null, false)
                ->where('a.catatan_konfrm_pemda !=', '-')
                ->groupEnd()
                ->groupEnd(); // tutup grup OR
            $builder->orderBy('a.catatan_pemda', 'ASC');
        }
        $builder->where('a.thn_pelaksanaan', $tahun_pelaksanaan);
        $builder->orderBy('a.id_provinsi', 'ASC');
        // Eksekusi

        // echo $builder->getCompiledSelect();
        // exit;
        $query = $builder->get();
        return $query->getResult();
    }
}
