<?php

namespace App\Models\Rakorbangwil;

use CodeIgniter\Model;

class DaftarProgTahunanModel extends Model
{
    protected $table = 'view_prog_tahunan';
    protected $primaryKey = 'id_prog_tahunan';
    protected $returnType = 'object';


    public function getDaftarProgramTahunan($id_provinsi, $id_unor, $sumber, $pn = "ALL", $catatan_kl = null, $pembiayaan = null, $tipe = null, $catatan_pra_rakorbangwil = null, $catatan_pemda = null, $konfirmasi_pemda = null, $kesepakatan = null, $pn_lama = null, $prakonreg = null)
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

        if ($pembiayaan) {
            if ($pembiayaan == 'x') {
                $builder->whereIn('a.id_pendanaan', [1, 3, 5, 6, 7]);
            } else {
                $builder->whereIn('a.id_pendanaan', $pembiayaan);
            }
        }

        if ($tipe) {
            $builder->where('a.tipe_pekerjaan', $tipe);
        }
        if ($prakonreg) {
            $builder->where('a.pra_konreg', $prakonreg);
        }
        if ($pn_lama) {
            $builder->where('pn_lama', $pn_lama);
        }
        if ($catatan_pra_rakorbangwil) {
            if ($catatan_pra_rakorbangwil == "ya") {
                $builder->where('a.catatan_pra_rakorbangwil IS NOT NULL', null, false)
                    ->where('a.catatan_pra_rakorbangwil !=', '-');
            } elseif ($catatan_pra_rakorbangwil == "tidak") {
                $builder->groupStart()
                    ->where('a.catatan_pra_rakorbangwil', null)
                    ->orWhere('a.catatan_pra_rakorbangwil', '-')
                    ->groupEnd();
            }
        }
        if ($catatan_pemda) {
            if ($catatan_pemda == "ya") {
                $builder->where('a.catatan_pemda IS NOT NULL', null, false)
                    ->where('a.catatan_pemda !=', '-');
            } elseif ($catatan_pemda == "tidak") {
                $builder->groupStart()
                    ->where('a.catatan_pemda', null)
                    ->orWhere('a.catatan_pemda', '-')
                    ->groupEnd();
            }
        }
        if ($konfirmasi_pemda) {
            if ($konfirmasi_pemda == "ya") {
                $builder->where('a.catatan_konfrm_pemda IS NOT NULL', null, false)
                    ->where('a.catatan_konfrm_pemda !=', '-');
            } elseif ($konfirmasi_pemda == "tidak") {
                $builder->groupStart()
                    ->where('a.catatan_konfrm_pemda', null)
                    ->orWhere('a.catatan_konfrm_pemda', '-')
                    ->groupEnd();
            }
        }
        if ($kesepakatan) {
            if ($kesepakatan == 99) {
                $builder->where('a.desk_rakorbangwil', 0);
            } else {
                $builder->where('a.desk_rakorbangwil', $kesepakatan);
            }
        }
        // if ($kesepakatan) {
        //     $builder->where('a.desk_rakorbangwil', $kesepakatan);
        // }
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
        if ($pn) {
            if ($pn == "ALLPN") {
                $builder->where('a.id_pn is not null', null, false);
                $builder->orderBy('a.catatan_konfrm_pemda', 'DESC');
                $builder->orderBy('a.catatan_pemda', 'DESC');
            } elseif ($pn == "x") {
                $builder->where('a.id_pn', null);
            } else {
                $builder->where('a.id_pn', $pn);
            }
        }
        $builder->orderBy('a.id_prog_tahunan', 'ASC');
        // Eksekusi
        $query = $builder->get();
        return $query->getResult();
    }
    public function countPekerjaanByKawasan($kawasan, $provinsi = null, $pn = null, $sumber = null, $unor = null, $catatan_kl = null, $pembiayaan = null)
    {
        $builder = $this->builder('view_prog_tahunan');

        $builder->select('COUNT(*) as total')
            ->where('kawasan', $kawasan);

        // ===== FILTER PROVINSI =====
        if (!empty($provinsi) && $provinsi !== "ALL") {
            $builder->where('id_provinsi', $provinsi);
        }

        // ===== FILTER PN =====
        if (!empty($pn) && $pn !== "ALLPN") {
            $builder->where('pn', $pn);
        }

        // ===== FILTER SUMBER =====
        if (!empty($sumber)) {
            $builder->where('sumber_pendanaan', $sumber);
        }

        // ===== FILTER UNOR =====
        if (!empty($unor)) {
            $builder->where('id_unor', $unor);
        }

        if ($pembiayaan) {
            $builder->where('id_pendanaan', $pembiayaan);
        }
        if ($catatan_kl) {
            $builder->groupStart() // buka grup OR
                ->groupStart()
                ->where('kebutuhan_dukungan_kl IS NOT NULL', null, false)
                ->where('kebutuhan_dukungan_kl !=', '-')
                ->groupEnd()
                ->orGroupStart()
                ->where('catatan_konfrm_pemda IS NOT NULL', null, false)
                ->where('catatan_konfrm_pemda !=', '-')
                ->groupEnd()
                ->groupEnd(); // tutup grup OR
            $builder->orderBy('catatan_pemda', 'ASC');
        }
        $result = $builder->get()->getRow();
        return $result ? $result->total : 0;
    }
    public function getRekapKawasanPnPerProvinsi()
    {
        $db = \Config\Database::connect();

        $sql = "
       SELECT e.provinsi,
COUNT(DISTINCT(IF(d.id_pn='2',c.kode_kawasan,NULL))) pn2_kawasan,
COUNT(DISTINCT(IF(d.id_pn='3',c.kode_kawasan,NULL))) pn3_kawasan,
COUNT(DISTINCT(IF(d.id_pn='4',c.kode_kawasan,NULL))) pn4_kawasan,
COUNT(DISTINCT(IF(d.id_pn='5',c.kode_kawasan,NULL))) pn5_kawasan,
COUNT(DISTINCT(IF(d.id_pn='6',c.kode_kawasan,NULL))) pn6_kawasan,
COUNT(DISTINCT(IF(d.id_pn='8',c.kode_kawasan,NULL))) pn8_kawasan,
COUNT(DISTINCT(c.kode_kawasan)) kawasan
FROM prog_tahunan a LEFT JOIN prog_tahunan_kwsn b ON a.id_prog_tahunan=b.id_prog_tahunan
LEFT JOIN m_kawasan c ON b.id_kawasan=c.kode_kawasan
LEFT JOIN m_sk_ro d ON a.id_ro=d.id_ro
LEFT JOIN m_provinsi e ON a.id_provinsi=e.id
WHERE a.thn_pelaksanaan='2027' AND d.id_pn IN ('2','3','4','5','6','8') AND a.desk_rakorbangwil IN ('1','2')
GROUP BY a.id_provinsi
ORDER BY a.id_provinsi
    ";

        return $db->query($sql)->getResult();
    }

    public function getRekapKegiatanAnggaranPerProvinsi($id_pn)
    {
        $db = \Config\Database::connect();

        $sql = "
        SELECT a.provinsi,
            COUNT(IF(a.id_unor='6',a.pekerjaan,NULL)) AS sda_pekerjaan,
            SUM(IF(a.id_unor='6',a.anggaran,NULL)) AS sda_anggaran,
            COUNT(IF(a.id_unor='4',a.pekerjaan,NULL)) AS bm_pekerjaan,
            SUM(IF(a.id_unor='4',a.anggaran,NULL)) AS bm_anggaran,
            COUNT(IF(a.id_unor='5',a.pekerjaan,NULL)) AS ck_pekerjaan,
            SUM(IF(a.id_unor='5',a.anggaran,NULL)) AS ck_anggaran,
            COUNT(IF(a.id_unor='8',a.pekerjaan,NULL)) AS ps_pekerjaan,
            SUM(IF(a.id_unor='8',a.anggaran,NULL)) AS ps_anggaran,
            COUNT(*) AS pekerjaan,
            SUM(a.anggaran) AS anggaran
        FROM view_prog_tahunan a
        WHERE a.thn_pelaksanaan = '2027'
          AND a.desk_rakorbangwil = '1'
          AND a.id_pn = ?
        GROUP BY a.provinsi
        ORDER BY a.id_provinsi
    ";

        return $db->query($sql, [$id_pn])->getResult();
    }
    public function getListKegiatanPerUnor($id_unor)
    {
        $db = \Config\Database::connect();

        $sql = "
        SELECT 
            a.id_pn,
            a.provinsi,
            a.pekerjaan,
            a.kawasan_panjang,
            a.volume,
            a.nama_satuan,
            a.anggaran,
            a.kesepakatan
        FROM view_prog_tahunan a
        WHERE a.thn_pelaksanaan = '2027'
          AND a.id_pn IN ('2','3','4','5','6','8')
          AND a.desk_rakorbangwil = '1'
          AND a.id_unor = ?
        ORDER BY 
            a.id_provinsi,
            a.id_pn,
            a.kawasan_panjang,
            a.pekerjaan
    ";

        return $db->query($sql, [$id_unor])->getResult();
    }
    public function getRekapDiAkomodasi()
    {
        $db = \Config\Database::connect();

        $sql = "
        SELECT a.provinsi,
COUNT(IF(a.id_unor='6',a.pekerjaan,NULL)) AS sda_pekerjaan,
SUM(IF(a.id_unor='6',a.anggaran,0)) AS sda_anggaran,
COUNT(IF(a.id_unor='4',a.pekerjaan,NULL)) AS bm_pekerjaan,
SUM(IF(a.id_unor='4',a.anggaran,0)) AS bm_anggaran,
COUNT(IF(a.id_unor='5',a.pekerjaan,NULL)) AS ck_pekerjaan,
SUM(IF(a.id_unor='5',a.anggaran,0)) AS ck_anggaran,
COUNT(*) pekerjaan,SUM(a.anggaran) anggaran
FROM view_prog_tahunan a
WHERE thn_pelaksanaan='2027' AND a.id_pn IN ('2','3','4','5','6','8') AND a.desk_rakorbangwil='2'
GROUP BY a.id_provinsi
ORDER BY a.id_provinsi
    ";

        return $db->query($sql)->getResult();
    }
    public function getRekapDiAkomodasiPN()
    {
        $db = \Config\Database::connect();

        $sql = "
        SELECT CONCAT('Prinoritas Nasional ',a.id_pn,' - ',a.nama_pn) AS pn,
COUNT(IF(a.id_unor='6',a.pekerjaan,NULL)) AS sda_pekerjaan,
SUM(IF(a.id_unor='6',a.anggaran,0)) AS sda_anggaran,
COUNT(IF(a.id_unor='4',a.pekerjaan,NULL)) AS bm_pekerjaan,
SUM(IF(a.id_unor='4',a.anggaran,0)) AS bm_anggaran,
COUNT(IF(a.id_unor='5',a.pekerjaan,NULL)) AS ck_pekerjaan,
SUM(IF(a.id_unor='5',a.anggaran,0)) AS ck_anggaran,
COUNT(IF(a.id_unor='8',a.pekerjaan,NULL)) AS ps_pekerjaan,
SUM(IF(a.id_unor='8',a.anggaran,0)) AS ps_anggaran,
COUNT(*) pekerjaan,SUM(a.anggaran) anggaran
FROM view_prog_tahunan a
WHERE thn_pelaksanaan='2027' AND a.id_pn IN ('2','3','4','5','6','8') AND a.desk_rakorbangwil='1'
GROUP BY a.id_pn
ORDER BY a.id_pn
    ";

        return $db->query($sql)->getResult();
    }
}
