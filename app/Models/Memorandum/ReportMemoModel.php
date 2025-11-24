<?php

namespace App\Models\Memorandum;

use CodeIgniter\Model;

class ReportMemoModel extends Model
{
    protected $table = 'trx_prog_memorandum_1';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'id_provinsi', 'provinsi', 'id_unor', 'unor', 'id_pn', 'nama_pn', 'kawasan', 'tematik', 'kawasan_1', 'tematik_1', 'kawasan_2', 'tematik_2', 'kawasan_3', 'tematik_3', 'kawasan_4', 'tematik_4', 'kawasan_5', 'tematik_5', 'pekerjaan', 'rpm_1', 'phln_1', 'sbsn_1', 'other_1', 'rpm_2', 'phln_2', 'sbsn_2', 'other_2', 'rpm_3', 'phln_3', 'sbsn_3', 'other_3', 'rpm_4', 'phln_4', 'sbsn_4', 'other_4', 'rpm_5', 'phln_5', 'sbsn_5', 'other_5', 'periode', 'source_data'];

    public function getReportKawasanPerProvinsi($tahun_anggaran = null, $id_provinsi = null, $id_unor = null, $id_pn = null)
    {
        $builder = $this->db->table('sipro_kp.trx_prog_memorandum_kt');

        // $builder->select("tahun, provinsi, kawasan, tematik, pekerjaan, anggaran");
        // $builder->where('tahun', "$tahun_anggaran");
        // $builder->groupBy('provinsi');
        // $builder->orderBy('id_provinsi');
        // $query = $builder->get();
        // return $query->getResult();

        $builder->select(
            "provinsi, 
            COUNT(DISTINCT(IF(id_kawasan!=0,id_kawasan,NULL))) AS jml_kawasan,
            COUNT(DISTINCT(IF(id_tematik='1',id_tematik,NULL))) AS jml_afirmasi,
            COUNT(DISTINCT(IF(id_tematik='2',id_tematik,NULL))) AS jml_unggulan,
            COUNT(DISTINCT(IF(id_tematik='3',id_tematik,NULL))) AS jml_konservasi,
            COUNT(DISTINCT(IF(id_tematik='4',id_tematik,NULL))) AS jml_pertumbuhan,
            COUNT(DISTINCT(IF(id_tematik='5',id_tematik,NULL))) AS jml_swasembada"
        );

        $builder->where('tahun', "$tahun_anggaran");

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

    public function getReportKawasanPerProvinsiPerPN($tahun_anggaran = null, $id_provinsi = null, $id_unor = null, $id_pn = null)
    {
        $builder = $this->db->table('view_prog_memorandum_lap_pn_ktpa');

        $builder->select("tahun, provinsi, kawasan, pn2_kawasan, pn3_kawasan, pn4_kawasan, pn5_kawasan, pn6_kawasan, pn8_kawasan, tematik, pn2_tematik, pn3_tematik, pn4_tematik, pn5_tematik, pn6_tematik, pn8_tematik, pekerjaan, pn2_pekerjaan,
        pn3_pekerjaan, pn4_pekerjaan, pn5_pekerjaan, pn6_pekerjaan, pn8_pekerjaan, (anggaran - pn0_anggaran) as total_anggaran, pn2_anggaran, pn3_anggaran, pn4_anggaran, pn5_anggaran, pn6_anggaran, pn8_anggaran");
        $builder->where('tahun', "$tahun_anggaran");
        $builder->groupBy('provinsi');
        $builder->orderBy('id_provinsi');

        // echo $builder->getCompiledSelect();
        // exit;

        $query = $builder->get();
        return $query->getResult();
    }

    public function getReportKawasanPerProvinsiPerUnor($tahun_anggaran = null)
    {
        $builder = $this->db->table('view_prog_memorandum_lap_unor_ktpa');

        $builder->select("tahun, provinsi, kawasan, sda_kawasan, bm_kawasan, ck_kawasan, ps_kawasan, tematik, sda_tematik, bm_tematik, ck_tematik, ps_tematik, pekerjaan, sda_pekerjaan, bm_pekerjaan, ck_pekerjaan, ps_pekerjaan, anggaran, sda_anggaran, bm_anggaran, ck_anggaran, ps_anggaran");
        $builder->where('tahun', "$tahun_anggaran");
        $builder->groupBy('provinsi');
        $builder->orderBy('id_provinsi');
        $query = $builder->get();
        return $query->getResult();
        // echo $builder->getCompiledSelect();
        // echo $this->db->getLastQuery();
        // exit;
    }

    public function getReportAnggaranPerProvinsi($tahun_anggaran = null, $id_provinsi = null, $id_unor = null, $id_pn = null)
    {
        // $builder = $this->db->table('view_prog_memorandum_lap_ktpa');

        // $builder->select("tahun, provinsi, anggaran, rpm, phln, sbsn, (rpm + phln + sbsn) as total_apbn, other");
        // $builder->where('tahun', "$tahun_anggaran");
        // $builder->groupBy('provinsi');
        // $builder->orderBy('id_provinsi');

        $tahun = (int)$tahun_anggaran;
        $builder = $this->db->table('trx_prog_memorandum_pa');

        $builder->select("provinsi,
            SUM(        
                CASE
                    WHEN $tahun = 2025 THEN pekerjaan_1
                    WHEN $tahun = 2026 THEN pekerjaan_2
                    WHEN $tahun = 2027 THEN pekerjaan_3
                    WHEN $tahun = 2028 THEN pekerjaan_4
                    WHEN $tahun = 2029 THEN pekerjaan_5
                    WHEN $tahun = 2529 THEN pekerjaan
                    ELSE 0
                END
            ) AS total_pekerjaan,

            SUM(
                CASE
                    WHEN $tahun = 2025 THEN anggaran_1
                    WHEN $tahun = 2026 THEN anggaran_2
                    WHEN $tahun = 2027 THEN anggaran_3
                    WHEN $tahun = 2028 THEN anggaran_4
                    WHEN $tahun = 2029 THEN anggaran_5
                    WHEN $tahun = 2529 THEN anggaran
                    ELSE 0
                END 
            ) AS total_anggaran,
        
            SUM(
                CASE
                    WHEN $tahun = 2025 THEN rpm_1
                    WHEN $tahun = 2026 THEN rpm_2
                    WHEN $tahun = 2027 THEN rpm_3
                    WHEN $tahun = 2028 THEN rpm_4
                    WHEN $tahun = 2029 THEN rpm_5
                    WHEN $tahun = 2529 THEN rpm
                    ELSE 0
                END
            ) AS total_rpm,

            SUM(
                CASE
                    WHEN $tahun = 2025 THEN phln_1
                    WHEN $tahun = 2026 THEN phln_2
                    WHEN $tahun = 2027 THEN phln_3
                    WHEN $tahun = 2028 THEN phln_4
                    WHEN $tahun = 2029 THEN phln_5
                    WHEN $tahun = 2529 THEN phln
                    ELSE 0
                END
            ) AS total_phln,

            SUM(
                CASE
                    WHEN $tahun = 2025 THEN sbsn_1
                    WHEN $tahun = 2026 THEN sbsn_2
                    WHEN $tahun = 2027 THEN sbsn_3
                    WHEN $tahun = 2028 THEN sbsn_4
                    WHEN $tahun = 2029 THEN sbsn_5
                    WHEN $tahun = 2529 THEN sbsn
                    ELSE 0
                END
            ) AS total_sbsn,

            SUM(
                CASE
                    WHEN $tahun = 2025 THEN other_1
                    WHEN $tahun = 2026 THEN other_2
                    WHEN $tahun = 2027 THEN other_3
                    WHEN $tahun = 2028 THEN other_4
                    WHEN $tahun = 2029 THEN other_5
                    WHEN $tahun = 2529 THEN other
                    ELSE 0
                END
            ) AS total_other,

            (
                SUM(CASE
                        WHEN $tahun = 2025 THEN rpm_1
                        WHEN $tahun = 2026 THEN rpm_2
                        WHEN $tahun = 2027 THEN rpm_3
                        WHEN $tahun = 2028 THEN rpm_4
                        WHEN $tahun = 2029 THEN rpm_5
                        WHEN $tahun = 2529 THEN rpm
                        ELSE 0
                    END
                )
                +
                SUM(CASE
                        WHEN $tahun = 2025 THEN phln_1
                        WHEN $tahun = 2026 THEN phln_2
                        WHEN $tahun = 2027 THEN phln_3
                        WHEN $tahun = 2028 THEN phln_4
                        WHEN $tahun = 2029 THEN phln_5
                        WHEN $tahun = 2529 THEN phln
                        ELSE 0
                    END
                )
                +
                SUM(CASE
                       WHEN $tahun = 2025 THEN sbsn_1
                        WHEN $tahun = 2026 THEN sbsn_2
                        WHEN $tahun = 2027 THEN sbsn_3
                        WHEN $tahun = 2028 THEN sbsn_4
                        WHEN $tahun = 2029 THEN sbsn_5
                        WHEN $tahun = 2529 THEN sbsn
                        ELSE 0
                    END
                )
            ) AS total_apbn
        ");

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

        $query = $builder->get();
        return $query->getResult();
        // echo $builder->getCompiledSelect();
        // echo $this->db->getLastQuery();
        // exit;
    }
}
