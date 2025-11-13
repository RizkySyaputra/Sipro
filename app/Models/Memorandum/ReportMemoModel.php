<?php

namespace App\Models\Memorandum;

use CodeIgniter\Model;

class ReportMemoModel extends Model
{
    protected $table = 'trx_prog_memorandum_1';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'id_provinsi', 'provinsi', 'id_unor', 'unor', 'id_pn', 'nama_pn', 'kawasan', 'tematik', 'kawasan_1', 'tematik_1', 'kawasan_2', 'tematik_2', 'kawasan_3', 'tematik_3', 'kawasan_4', 'tematik_4', 'kawasan_5', 'tematik_5', 'pekerjaan', 'rpm_1', 'phln_1', 'sbsn_1', 'other_1', 'rpm_2', 'phln_2', 'sbsn_2', 'other_2', 'rpm_3', 'phln_3', 'sbsn_3', 'other_3', 'rpm_4', 'phln_4', 'sbsn_4', 'other_4', 'rpm_5', 'phln_5', 'sbsn_5', 'other_5', 'periode', 'source_data'];

    public function getReportKawasanPerProvinsi($tahun_anggaran = null)
    {
        $builder = $this->db->table('view_prog_memorandum_lap_ktpa');

        $builder->select("tahun, provinsi, kawasan, tematik, pekerjaan, anggaran");
        $builder->where('tahun', "$tahun_anggaran");
        $builder->groupBy('provinsi');
        $builder->orderBy('id_provinsi');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getReportKawasanPerProvinsiPerPN($tahun_anggaran = null)
    {
        $builder = $this->db->table('view_prog_memorandum_lap_pn_ktpa');

        $builder->select("tahun, provinsi, kawasan, pn2_kawasan, pn3_kawasan, pn4_kawasan, pn5_kawasan, pn6_kawasan, pn8_kawasan, tematik, pn2_tematik, pn3_tematik, pn4_tematik, pn5_tematik, pn6_tematik, pn8_tematik, pekerjaan, pn2_pekerjaan,
        pn3_pekerjaan, pn4_pekerjaan, pn5_pekerjaan, pn6_pekerjaan, pn8_pekerjaan, (anggaran - pn0_anggaran) as total_anggaran, pn2_anggaran, pn3_anggaran, pn4_anggaran, pn5_anggaran, pn6_anggaran, pn8_anggaran");
        $builder->where('tahun', "$tahun_anggaran");
        $builder->groupBy('provinsi');
        $builder->orderBy('id_provinsi');
        $query = $builder->get();
        return $query->getResult();
        // echo $builder->getCompiledSelect();
        // echo $this->db->getLastQuery();
        // exit;
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

    public function getReportAnggaranPerProvinsi($tahun_anggaran = null)
    {
        $builder = $this->db->table('view_prog_memorandum_lap_ktpa');

        $builder->select("tahun, provinsi, anggaran, rpm, phln, sbsn, (rpm + phln + sbsn) as total_apbn, other");
        $builder->where('tahun', "$tahun_anggaran");
        $builder->groupBy('provinsi');
        $builder->orderBy('id_provinsi');
        $query = $builder->get();
        return $query->getResult();
        // echo $builder->getCompiledSelect();
        // echo $this->db->getLastQuery();
    }
}
