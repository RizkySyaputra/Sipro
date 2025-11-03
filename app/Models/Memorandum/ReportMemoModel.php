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
        $builder = $this->db->table('trx_prog_memorandum_1');

        if (!empty($tahun_anggaran)) {
            $kawasanMap = [
                2025 => 'kawasan_1',
                2026 => 'kawasan_2',
                2027 => 'kawasan_3',
                2028 => 'kawasan_4',
                2029 => 'kawasan_5',
            ];

            $tematikMap = [
                2025 => 'tematik_1',
                2026 => 'tematik_2',
                2027 => 'tematik_3',
                2028 => 'tematik_4',
                2029 => 'tematik_5',
            ];

            $kawasan = $kawasanMap[$tahun_anggaran];
            $tematik = $tematikMap[$tahun_anggaran];

            $builder->select("provinsi, sum({$kawasan}) as jumlah_kawasan, sum({$tematik}) as jumlah_tematik, sum(pekerjaan) as jumlah_pekerjaan");
        }

        $builder->groupBy('provinsi');
        $builder->orderBy('id');
        $query = $builder->get();
        // echo $builder->getCompiledSelect();
        // echo $this->db->getLastQuery();
        return $query->getResult();
    }

    public function getReportKawasanPerProvinsiPerPN($tahun_anggaran = null)
    {
        $builder = $this->db->table('trx_prog_memorandum_1');

        if (!empty($tahun_anggaran)) {

            $pnList = [2, 3, 4, 5, 6, 8];

            $kawasanMap = [
                2025 => 'kawasan_1',
                2026 => 'kawasan_2',
                2027 => 'kawasan_3',
                2028 => 'kawasan_4',
                2029 => 'kawasan_5',
            ];

            $tematikMap = [
                2025 => 'tematik_1',
                2026 => 'tematik_2',
                2027 => 'tematik_3',
                2028 => 'tematik_4',
                2029 => 'tematik_5',
            ];

            $kawasan = $kawasanMap[$tahun_anggaran];
            $tematik = $tematikMap[$tahun_anggaran];

            // $select = "provinsi, sum({$kawasan}) as jumlah_kawasan, sum({$tematik}) as jumlah_tematik, sum(pekerjaan) as jumlah_pekerjaan";
            $select = "provinsi";

            // Loop untuk tiap PN
            foreach ($pnList as $pn) {
                $select .= ", sum(CASE WHEN `id_pn` = $pn THEN $kawasan ELSE 0 END) as pn{$pn}_kawasan";
                $select .= ", sum(CASE WHEN `id_pn` = $pn THEN $tematik ELSE 0 END) as pn{$pn}_tematik_kawasan";
                $select .= ", sum(CASE WHEN `id_pn` = $pn THEN pekerjaan ELSE 0 END) as pn{$pn}_pekerjaan";
            }

            $builder->select($select);
        }

        $builder->groupBy('provinsi');
        $builder->orderBy('id');
        // echo $builder->getCompiledSelect();
        // exit;
        $query = $builder->get();
        return $query->getResult();
    }

    public function getReportKawasanPerProvinsiPerUnor($tahun_anggaran = null)
    {
        $builder = $this->db->table('trx_prog_memorandum_1');

        if (!empty($tahun_anggaran)) {

            $unorList = [6, 4, 5, 8];

            $kawasanMap = [
                2025 => 'kawasan_1',
                2026 => 'kawasan_2',
                2027 => 'kawasan_3',
                2028 => 'kawasan_4',
                2029 => 'kawasan_5',
            ];

            $tematikMap = [
                2025 => 'tematik_1',
                2026 => 'tematik_2',
                2027 => 'tematik_3',
                2028 => 'tematik_4',
                2029 => 'tematik_5',
            ];

            $kawasan = $kawasanMap[$tahun_anggaran];
            $tematik = $tematikMap[$tahun_anggaran];

            $select = "provinsi";

            // Loop untuk tiap PN
            foreach ($unorList as $unor) {
                $select .= ", sum(CASE WHEN `id_unor` = $unor THEN $kawasan ELSE 0 END) as unor{$unor}_kawasan";
                $select .= ", sum(CASE WHEN `id_unor` = $unor THEN $tematik ELSE 0 END) as unor{$unor}_tematik_kawasan";
                $select .= ", sum(CASE WHEN `id_unor` = $unor THEN pekerjaan ELSE 0 END) as unor{$unor}_pekerjaan";
            }

            $builder->select($select);
        }

        $builder->groupBy('provinsi');
        $builder->orderBy('id');
        // echo $builder->getCompiledSelect();
        // exit;
        $query = $builder->get();
        return $query->getResult();
    }

    public function getReportAnggaranPerProvinsi($tahun_anggaran = null, $unor = null, $pn = null)
    {
        $builder = $this->db->table('trx_prog_memorandum_1');

        if (!empty($tahun_anggaran)) {
            $rpmMap = [
                2025 => 'rpm_1',
                2026 => 'rpm_2',
                2027 => 'rpm_3',
                2028 => 'rpm_4',
                2029 => 'rpm_5',
            ];

            $phlnMap = [
                2025 => 'phln_1',
                2026 => 'phln_2',
                2027 => 'phln_3',
                2028 => 'phln_4',
                2029 => 'phln_5',
            ];

            $sbsnMap = [
                2025 => 'sbsn_1',
                2026 => 'sbsn_2',
                2027 => 'sbsn_3',
                2028 => 'sbsn_4',
                2029 => 'sbsn_5',
            ];

            $otherMap = [
                2025 => 'other_1',
                2026 => 'other_2',
                2027 => 'other_3',
                2028 => 'other_4',
                2029 => 'other_5',
            ];

            $rpm    = $rpmMap[$tahun_anggaran];
            $phln   = $phlnMap[$tahun_anggaran];
            $sbsn   = $sbsnMap[$tahun_anggaran];
            $other  = $otherMap[$tahun_anggaran];

            $builder->select("provinsi, sum({$rpm}) as jumlah_rpm, sum({$phln}) as jumlah_phln, sum({$sbsn}) as jumlah_sbsn, sum({$rpm})+sum({$phln})+sum({$sbsn}) as total_provinsi_apbn, sum({$other}) as jumlah_lainnya");
        }

        if (!empty($unor)) {
            $builder->where('id_unor', $unor);
        }

        if (!empty($pn)) {
            $builder->where('id_pn', $pn);
        }

        $builder->groupBy('provinsi');
        $builder->orderBy('id');
        $query = $builder->get();
        // echo $builder->getCompiledSelect();
        // echo $this->db->getLastQuery();
        return $query->getResult();
    }
}
