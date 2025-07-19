<?php

namespace App\Models\Desk;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class DeskModel extends Model
{
    protected $table = 'memorandum_program';
    protected $primaryKey = 'id_mprogram';
    protected $allowedFields = ['id_mprogram', 'id_rpiw', 'id_provinsi', 'id_unor', 'nama_program', 'lokasi', 'justifikasi', 'kesiapan_rc', 'volume', 'id_satuan', 'biaya', 'id_pendanaan', 'tagging_mp', 'catatan_bpiw', 'catatan_unor', 'catatan_k/l',  'geojson', 'tahun_anggaran' , 'source_data', 'desk'];
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
    public function getProgramMemo($id_provinsi, $id_unor, $sumber = null, $desk = null)
    {
        //penggunaan cache agar lebih cepat load. !
        // $this->cache = \Config\Services::cache();
        // $cacheKey = 'program_data'; // Kunci cache
        // $cacheTime = 3600; // Waktu cache dalam detik (1 jam)
        // if ($this->cache->get($cacheKey)) {
        //     return $this->cache->get($cacheKey); // Mengembalikan data dari cache
        // }
        $builder = $this->db->table('memorandum_program as memo');
        $builder->select('memo.*,  m_provinsi.provinsi, m_unor.unor, m_pendanaan.sumber_pendanaan, m_satuan.nama_satuan');
        $builder->distinct();
        $builder->join('m_provinsi', 'memo.id_provinsi = m_provinsi.id', 'left');
        $builder->join('m_unor', 'memo.id_unor = m_unor.id', 'left');
        $builder->join('m_pendanaan', 'memo.id_pendanaan = m_pendanaan.id_pendanaan', 'left ');
        $builder->join('m_satuan', 'memo.id_satuan = m_satuan.id_satuan', 'left');
        $builder->join('r_program_kawasan', 'memo.id_rpiw = r_program_kawasan.kode_program', 'left');
        $builder->orderBy('created_at', 'DESC');
        // $builder->where('memo.tahun_mulai <=', $tahun_anggaran);
        // $builder->where('memo.tahun_selesai >=', $tahun_anggaran);
        // Tambahkan kondisi untuk filter jika parameter tidak null
        if ($id_provinsi) {
            $builder->where('memo.id_provinsi', $id_provinsi);
        }
        if ($id_unor) {
            $builder->where('memo.id_unor', $id_unor);
        }
        if ($sumber) {
            $builder->where('memo.source_data', $sumber);
        }
        if ($desk) {
            $builder->where('memo.desk', $desk);
        }

        $query = $builder->get();
        // $this->cache->save($cacheKey, $query->getResult(), $cacheTime);
        return $query->getResult();
    }

public function add_catatan($id_mprogram, $catatan_bpiw = null, $catatan_unor = null, $catatan_kl = null, $nama_program, $volume, $id_satuan, $biaya, $kesiapan_rc, $desk = null)
    {
        $data = [
            'catatan_bpiw' => $catatan_bpiw,
            'catatan_unor' => $catatan_unor,
            'catatan_k/l' => $catatan_kl,
            'nama_program' => $nama_program,
            'volume' => $volume,
            'id_satuan' => $id_satuan,
            'biaya' => $biaya,
            'kesiapan_rc' => $kesiapan_rc,
            'desk' => $desk 
        ];

        $this->update($id_mprogram, $data);
    }

    public function getProgramMemorandumById($id_memo)
    {
        $builder = $this->db->table('memorandum_program as memo');
        $builder->select('memo.*, m_provinsi.*, m_unor.unor, m_pendanaan.sumber_pendanaan, m_satuan.nama_satuan, m_mp.* ');
        $builder->join('m_provinsi', 'memo.id_provinsi = m_provinsi.id', 'left');
        $builder->join('m_unor', 'memo.id_unor = m_unor.id', 'left');
        $builder->join('m_pendanaan', 'memo.id_pendanaan = m_pendanaan.id_pendanaan', 'left');
        $builder->join('m_satuan', 'memo.id_satuan = m_satuan.id_satuan', 'left');
        $builder->join('m_mp', 'memo.tagging_mp = m_mp.id_mp', 'left');
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
        ];
        if ($this->insert($data)) {
            return "Sukses";
        } else {
            return "Gagal";
        }
    }
}
