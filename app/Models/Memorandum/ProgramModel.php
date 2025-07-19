<?php

namespace App\Models\Memorandum;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class ProgramModel extends Model
{
    protected $table = 'memorandum_program';
    protected $primaryKey = 'id_mprogram';
    protected $allowedFields = ['id_mprogram', 'id_rpiw', 'id_provinsi', 'id_unor', 'nama_program', 'lokasi', 'justifikasi', 'kesiapan_rc', 'volume', 'id_satuan', 'biaya', 'id_pendanaan', 'tagging_mp', 'catatan_bpiw', 'catatan_unor', 'catatan_kl',  'geojson', 'tahun_anggaran', 'source_data', 'desk', 'desk2', 'catatan_desk2', 'pradesk_konreg', 'catatan_pradesk_konreg'];
    protected $useTimestamps  = 'true';
    protected $cache;

    public function getIdProgramMemo($prefix)
    {
        $builder = $this->db->table('memorandum_program as memo');
        $builder->select('id_mprogram');
        $builder->like('id_mprogram', $prefix);
        $query = $builder->get();
        return $query->getResult();
    }
    public function getProgramMemo($id_provinsi, $id_unor, $id_kawasan = null, $desk = null, $sumber = null, $pendanaan_id = null, $desk2 = null, $pradesk = null)
    {
        $builder = $this->db->table('memorandum_program as a');

        // SELECT clause
        $builder->select("
            a.id_mprogram,
            a.pradesk_konreg,
            a.id_rpiw,
            a.id_provinsi,
            b.provinsi,
            c.unor,
            a.nama_program,
            IFNULL(g.kawasan, 'Non Kawasan') AS kawasan,
            a.lokasi,
            IF(SUBSTR(a.justifikasi,1,1)='-', CONCAT(\"'\", a.justifikasi), a.justifikasi) AS justifikasi,
            a.kesiapan_rc,
            a.volume,
            d.nama_satuan,
            a.biaya,
            e.sumber_pendanaan,
            f.nama_mp,
            a.source_data,
            g.kode_kawasan,
            IF(SUBSTR(a.catatan_bpiw,1,1)='-', CONCAT(\"'\", a.catatan_bpiw), a.catatan_bpiw) AS catatan_bpiw,
            IF(SUBSTR(a.catatan_unor,1,1)='-', CONCAT(\"'\", a.catatan_unor), a.catatan_unor) AS catatan_unor,
            IF(SUBSTR(a.catatan_desk2,1,1)='-', CONCAT(\"'\", a.catatan_desk2), a.catatan_desk2) AS catatan_desk,
            IF(a.desk2 = '1', 'Diakomodir', '-') AS kesepakatan
        ");

        // JOINs utama
        $builder->join('m_provinsi b', 'a.id_provinsi = b.id', 'left');
        $builder->join('m_unor c', 'a.id_unor = c.id', 'left');
        $builder->join('m_satuan d', 'a.id_satuan = d.id_satuan', 'left');
        $builder->join('m_pendanaan e', 'a.id_pendanaan = e.id_pendanaan', 'left');
        $builder->join('m_mp f', 'a.tagging_mp = f.id_mp', 'left');

        // Subquery untuk join kawasan
        $subquery = $this->db->table('memorandum_program a')
            ->select('a.id_mprogram, b.kode_program, GROUP_CONCAT(c.nama_kawasan SEPARATOR ", ") AS kawasan, 
              GROUP_CONCAT(c.kode_kawasan SEPARATOR ", ") AS kode_kawasan')
            ->join('r_program_kawasan b', 'a.id_rpiw = b.kode_program', 'left')
            ->join('m_kawasan c', 'b.kode_kawasan = c.kode_kawasan', 'left')
            ->where('a.desk', '1')
            ->where('a.desk2', '1')
            ->where('a.id_pendanaan', '1')
            ->groupBy('a.id_mprogram');

        // Masukkan subquery ke dalam join
        $builder->join("({$subquery->getCompiledSelect(false)}) g", 'a.id_mprogram = g.id_mprogram', 'left');

        // WHERE clause
        if ($id_provinsi) {
            $builder->where('a.id_provinsi', $id_provinsi);
        }
        if ($id_unor) {
            $builder->where('a.id_unor', $id_unor);
        }
        if ($id_kawasan) {
            $builder->where('a.kode_kawasan', $id_kawasan);
        }
        if ($desk) {
            $builder->where('a.desk', $desk);
        }
        if ($sumber) {
            $builder->where('a.source_data', $sumber);
        }
        if ($pendanaan_id) {
            $builder->where('a.id_pendanaan', $pendanaan_id);
        }
        if ($desk2) {
            $builder->where('a.desk2', $desk2);
        }
        if ($pradesk != "") {
            $builder->where('a.pradesk_konreg', $pradesk);
        }
        // $builder->where('a.desk', '1');
        // $builder->where('a.desk2', '1');
        // $builder->where('a.id_pendanaan', '1');

        // ORDER BY
        $builder->orderBy('a.id_mprogram', 'ASC');

        // Eksekusi
        $query = $builder->get();
        return $query->getResult();
    }

    public function add_catatan($id_mprogram, $catatan_bpiw = null, $catatan_unor = null, $catatan_desk2 = null, $nama_program, $volume, $id_satuan, $biaya, $kesiapan_rc, $desk = null, $id_pendanaan, $desk2 = null)
    {
        $data = [
            'catatan_bpiw' => $catatan_bpiw,
            'catatan_unor' => $catatan_unor,
            'catatan_desk2' => $catatan_desk2,
            'nama_program' => $nama_program,
            'volume' => $volume,
            'id_satuan' => $id_satuan,
            'biaya' => $biaya,
            'kesiapan_rc' => $kesiapan_rc,
            'desk' => $desk,
            'id_pendanaan' => $id_pendanaan,
            'desk2' => $desk2
        ];

        $this->update($id_mprogram, $data);
    }

    public function getProgramMemorandumById($id_memo)
    {
        $builder = $this->db->table('memorandum_program as memo');
        $builder->select('memo.*, m_program.kdprogram, m_program.nmprogram, m_provinsi.*, m_unor.unor, m_pendanaan.sumber_pendanaan, m_satuan.nama_satuan, m_mp.*, r_program_kawasan.kode_kawasan ');
        $builder->join('m_provinsi', 'memo.id_provinsi = m_provinsi.id', 'left');
        $builder->join('m_unor', 'memo.id_unor = m_unor.id', 'left');
        $builder->join('m_pendanaan', 'memo.id_pendanaan = m_pendanaan.id_pendanaan', 'left');
        $builder->join('m_satuan', 'memo.id_satuan = m_satuan.id_satuan', 'left');
        $builder->join('m_mp', 'memo.tagging_mp = m_mp.id_mp', 'left');
        $builder->join('r_program_kawasan', 'r_program_kawasan.kode_program = memo.id_rpiw', 'left');
        $builder->join('m_program', 'memo.id_unor = m_program.id_unor', 'left');
        $builder->where('memo.id_mprogram', $id_memo);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getProgramMemoDetail($id)
    {
        $builder = $this->db->table('m_rpiw_program');
        $builder->select('m_rpiw_program.*,  m_provinsi.*, m_unor.unor, m_pendanaan.sumber_pendanaan, m_satuan.nama_satuan');
        $builder->join('m_provinsi', 'm_rpiw_program.id_provinsi = m_provinsi.id', 'left');
        $builder->join('m_unor', 'm_rpiw_program.id_unor = m_unor.id', 'left');
        $builder->join('m_pendanaan', 'm_rpiw_program.id_pendanaan = m_pendanaan.id_pendanaan', 'left');
        $builder->join('m_satuan', 'm_rpiw_program.id_satuan = m_satuan.id_satuan', 'left');
        $builder->where('m_rpiw_program.id_program', $id);
        $query = $builder->get();
        return $query->getResult();
    }

    public function addMemorandumProgram(
        $id_mprogram,
        $provinsi_id,
        $unor_id,
        $program_id,
        $nama_program,
        $lokasi,
        $justifikasi,
        $kesiapan_rc,
        $volume,
        $biaya,
        $id_satuan,
        $id_pendanaan,
        $tagging_mp,
        $tahun_anggaran
    ) {
        $data = [
            'id_mprogram' => $id_mprogram,
            'id_rpiw'     => $program_id,
            'id_provinsi'    => $provinsi_id,
            'id_unor'        => $unor_id,
            'nama_program'   => $nama_program,
            'lokasi'         => $lokasi,
            'justifikasi'    => $justifikasi,
            'kesiapan_rc'    => $kesiapan_rc,
            'volume'         => $volume,
            'biaya'          => $biaya,
            'id_satuan'      => $id_satuan,
            'id_pendanaan'   => $id_pendanaan,
            'tagging_mp'     => $tagging_mp,
            'tahun_anggaran' => $tahun_anggaran,
            'source_data'   => 'RPIW'
        ];
        if ($this->insert($data)) {
            return "Sukses";
        } else {
            return "Gagal";
        }
    }

    public function getProgramKawasan($id_provinsi)
    {
        $builder = $this->db->table('memorandum_program as memo');
        $builder->select('m_kawasan.nama_kawasan, m_provinsi.*');
        $builder->distinct();
        $builder->join('m_provinsi', 'memo.id_provinsi = m_provinsi.id', 'left');
        $builder->join('r_program_kawasan', 'memo.id_rpiw = r_program_kawasan.kode_program', 'left');
        $builder->join('m_kawasan', 'r_program_kawasan.kode_kawasan = m_kawasan.kode_kawasan', 'left');
        $builder->orderBy('memo.created_at', 'DESC');
        $builder->where('memo.id_provinsi', $id_provinsi);
        $builder->where('memo.desk = 1');
        $builder->where('m_kawasan.nama_kawasan !=', null);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getProgramLaporan1($kesepakatan, $sumber_data, $pendanaan)
    {
        $builder = $this->db->table('memorandum_program as a');
        $builder->select([
            'a.id_provinsi',
            'b.provinsi',
            'COUNT(IF(a.id_unor = "4", a.nama_program, NULL)) AS program_bm',
            'COUNT(IF(a.id_unor = "5", a.nama_program, NULL)) AS program_ck',
            'COUNT(IF(a.id_unor = "6", a.nama_program, NULL)) AS program_sda',
            'COUNT(*) AS program',
            'SUM(IF(a.id_unor = "4", a.biaya, 0)) AS anggaran_bm',
            'SUM(IF(a.id_unor = "5", a.biaya, 0)) AS anggaran_ck',
            'SUM(IF(a.id_unor = "6", a.biaya, 0)) AS anggaran_sda',
            'SUM(a.biaya) AS anggaran',
        ]);

        $builder->join('m_provinsi b', 'a.id_provinsi = b.id', 'left');
        $builder->where('a.desk', '1');
        if ($kesepakatan) {
            if ($kesepakatan == 'x') {
                $kesepakatan == 0;
            }
            $builder->where('a.desk2', $kesepakatan);
        }
        if ($sumber_data) {
            $builder->where('a.source_data', $sumber_data);
        }
        if ($pendanaan) {
            $builder->where('a.id_pendanaan', $pendanaan);
        }

        $builder->groupBy('a.id_provinsi');
        $builder->orderBy('a.id_provinsi');

        // $builder->where('m_kawasan.nama_kawasan !=', null);
        $query = $builder->get();
        return $query->getResult();
    }


    public function getProgramLaporan2($unor,  $sumber_data, $pendanaan)
    {
        $builder = $this->db->table('memorandum_program as a');
        $builder->select([
            'a.id_provinsi',
            'b.provinsi',
            'COUNT(IF(desk2="0",a.nama_program,NULL)) AS program_ditangguhkan',
            'COUNT(IF(desk2="1",a.nama_program,NULL)) AS program_dilanjutkan',
            'COUNT(IF(desk2="3",a.nama_program,NULL)) AS program_blm_dibahas',
            'COUNT(*) program',
            'SUM(IF(desk2="0",a.biaya,0)) AS anggaran_ditangguhkan',
            'SUM(IF(desk2="1",a.biaya,0)) AS anggaran_dilanjutkan',
            'SUM(IF(desk2 IS NULL,a.biaya,0)) AS anggaran_blm_dibahas',
            'SUM(a.biaya) AS anggaran',
        ]);
        $builder->join('m_provinsi b', 'a.id_provinsi = b.id', 'left');
        $builder->where('a.desk', '1');
        if ($unor) {
            $builder->where('memo.unor', $unor);
        }
        if ($sumber_data) {
            $builder->where('memo.source_data', $sumber_data);
        }
        if ($pendanaan) {
            $builder->where('memo.id_pendanaan', $pendanaan);
        }

        $builder->groupBy('a.id_provinsi');
        $builder->orderBy('a.id_provinsi');
        // $builder->where('m_kawasan.nama_kawasan !=', null);
        $query = $builder->get();
        return $query->getResult();
    }
}
