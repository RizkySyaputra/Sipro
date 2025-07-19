<?php

namespace App\Models\Rpiw;

use CodeIgniter\Model;
use PhpParser\Node\Stmt\Echo_;

class ProgramRpiwModel extends Model
{
    protected $table = 'program_rpiw';
    protected $allowedFields = ['id_program', 'id_provinsi', 'id_unor', 'nama_program', 'lokasi', 'justifikasi', 'kesiapan_rc', 'volume', 'id_satuan', 'biaya', 'id_pendanaan', 'tahun_mulai', 'tahun_selesai', 'tagging_mp', 'tagging_manfaat', 'ta_2025', 'ta_2026', 'ta_2027', 'ta_2028', 'ta_2029', 'tagging_program',];
    protected $useTimestamps  = 'true';
    protected $cache;

    public function getProgramRpiw($id_provinsi = null, $id_unor = null, $id_kawasan = null, $tahun_anggaran = null, $residu = null)
    {
        $builder = $this->db->table('program_rpiw as rpiw');
        $builder->select('rpiw.*,  m_provinsi.provinsi, m_unor.unor, m_pendanaan.sumber_pendanaan, m_satuan.nama_satuan, m_mp.nama_mp');
        $builder->distinct();
        $builder->join('m_provinsi', 'rpiw.id_provinsi = m_provinsi.id', 'left');
        $builder->join('m_unor', 'rpiw.id_unor = m_unor.id', 'left');
        $builder->join('m_pendanaan', 'rpiw.id_pendanaan = m_pendanaan.id_pendanaan', 'left');
        $builder->join('m_satuan', 'rpiw.id_satuan = m_satuan.id_satuan', 'left');
        $builder->join('m_mp', 'rpiw.tagging_mp = m_mp.id_mp', 'left');
        $builder->join('r_program_kawasan', 'rpiw.id_program = r_program_kawasan.kode_program', 'left');
        // Tambahkan kondisi untuk filter jika parameter tidak null
        if ($id_provinsi) {
            $builder->where('rpiw.id_provinsi', $id_provinsi);
        }
        if ($id_unor) {
            $builder->where('rpiw.id_unor', $id_unor);
        }
        if ($id_kawasan) {
            $builder->where('r_program_kawasan.kode_kawasan', $id_kawasan);
        }
        if ($tahun_anggaran) {
            $builder->where('rpiw.tahun_mulai <=', $tahun_anggaran);
            $builder->where('rpiw.tahun_selesai >=', $tahun_anggaran);
        }
        if ($residu == 'residu') {
            $builder->where('rpiw.ta_2025 =', $residu);
        } elseif ($residu == 'non') {
            $builder->where('rpiw.ta_2025 !=', 'residu');
        }

        $query = $builder->get();
        return $query->getResult();
    }

    public function getProgramRpiwDetail($id)
    {
        // $program = $this->where(['id_program' => $id])->first();
        // return $this->find($id);
        $builder = $this->db->table('program_rpiw as rpiw');
        $builder->select('rpiw.*,  m_provinsi.*, m_unor.unor, m_pendanaan.sumber_pendanaan, m_satuan.nama_satuan, m_mp.nama_mp');
        $builder->join('m_provinsi', 'rpiw.id_provinsi = m_provinsi.id', 'left');
        $builder->join('m_unor', 'rpiw.id_unor = m_unor.id', 'left');
        $builder->join('m_pendanaan', 'rpiw.id_pendanaan = m_pendanaan.id_pendanaan', 'left');
        $builder->join('m_satuan', 'rpiw.id_satuan = m_satuan.id_satuan', 'left');
        $builder->join('m_mp', 'rpiw.tagging_mp = m_mp.id_mp', 'left');
        $builder->where('rpiw.id_program', $id);
        $query = $builder->get();
        return $query->getResult();
    }
}
