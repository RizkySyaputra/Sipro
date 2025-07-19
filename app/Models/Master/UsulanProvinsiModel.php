<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class UsulanProvinsiModel extends Model
{
    protected $table = 'k_usulan_provinsi';
    protected $primaryKey = 'id_usulan';
    protected $allowedFields = [
        'id_usulan',
        'id_pn',
        'id_pp',
        'id_kp',
        'id_prop',
        'tahun_diusulkan',
        'kd_prog',
        'kd_kgiat',
        'kd_kro',
        'kd_ro',
        'id_provinsi',
        'id_unor',
        'nama_pekerjaan',
        'volume',
        'id_satuan',
        'id_kawasan',
        'lokasi',
        'id_kabkot',
        'anggaran',
        'tahun_pelaksanaan',
        'id_pendanaan',
        'justifikasi',
        'ri',
        'ri_dokumen',
        'fs',
        'fs_dokumen',
        'dokling',
        'dokling_dokumen',
        'ded',
        'ded_dokumen',
        'lahan',
        'lahan_dokumen',
        'pasca_kontruksi',
        'pasca_kontruksi_dokumen',
        'menerima_bantuan',
        'menerima_bantuan_dokumen',
        'id_tematik',
        'tahun_pengerjaan',
        'catatan_unor',
        'geotag',
        'uraian_geotag',
        'FKS',
        'is_active',
        'no_prioritas',
        'user_id',
        'catatan_fup',
        'kesepakatan'
    ];
    public function updateCatatanUnor($id_usulan_provinsi, $catatan)
    {
        return $this->update($id_usulan_provinsi, [
            'catatan_unor' => $catatan
        ]);
    }
    public function getUsulan($id_provinsi = null, $id_unor = null, $id_pn = null, $kesepakatan = null)
    {
        $builder = $this->db->table('k_usulan_provinsi as usulan');
        $builder->select('usulan.*,  m_provinsi.provinsi, m_unor.unor, m_pendanaan.sumber_pendanaan, m_satuan.nama_satuan,  m_kawasan.nama_kawasan, k_pn.nama_pn, k_pp.nama_pp, k_kp.nama_kp, k_pro_p.nama_prop , m_ro.nmro, m_kro.nmkro');
        $builder->distinct();
        $builder->join('m_provinsi', 'usulan.id_provinsi = m_provinsi.id', 'left');
        $builder->join('m_unor', 'usulan.id_unor = m_unor.id', 'left');
        $builder->join('k_pn', 'usulan.id_pn = k_pn.id_pn', 'left');
        $builder->join('k_pp', 'usulan.id_pp = k_pp.id_pp', 'left');
        $builder->join('k_kp', 'usulan.id_kp = k_kp.id_kp', 'left');
        $builder->join('m_kro', 'usulan.kd_kro = m_kro.kdkro', 'left');
        $builder->join('m_ro', 'usulan.kd_ro = m_ro.kdro', 'left');
        $builder->join('k_pro_p', 'usulan.id_prop = k_pro_p.id_prop', 'left');
        $builder->join('m_satuan', 'usulan.id_satuan = m_satuan.id_satuan', 'left');
        $builder->join('m_pendanaan', 'usulan.id_pendanaan = m_pendanaan.id_pendanaan', 'left');
        $builder->join('m_kawasan', 'usulan.id_kawasan = m_kawasan.kode_kawasan', 'left');
        $builder->where('usulan.is_active', 1);
        // Tambahkan kondisi untuk filter jika parameter tidak null
        if ($id_provinsi) {
            $builder->where('usulan.id_provinsi', $id_provinsi);
        }
        if ($id_unor) {
            $builder->where('usulan.id_unor', $id_unor);
        }
        if ($id_pn) {
            $builder->where('usulan.id_pn', $id_pn);
        }
        if ($kesepakatan) {
            $builder->where('usulan.kesepakatan', $kesepakatan);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    public function getUsulanDetail($id)
    {
        $builder = $this->db->table('k_usulan_provinsi as usulan');
        $builder->select('usulan.*,  m_provinsi.provinsi, m_unor.unor, m_kabkot.kab_kot, m_kegiatan.nmgiat , m_kro.nmkro, m_ro.nmro, m_pendanaan.sumber_pendanaan, m_satuan.nama_satuan,  k_kawasan.nama_kawasan, k_pn.nama_pn, k_pp.nama_pp, k_kp.nama_kp, k_pro_p.nama_prop');
        $builder->distinct();
        $builder->join('m_provinsi', 'usulan.id_provinsi = m_provinsi.id', 'left');
        $builder->join('m_unor', 'usulan.id_unor = m_unor.id', 'left');
        $builder->join('k_pn', 'usulan.id_pn = k_pn.id_pn', 'left');
        $builder->join('k_pp', 'usulan.id_pp = k_pp.id_pp', 'left');
        $builder->join('k_kp', 'usulan.id_kp = k_kp.id_kp', 'left');
        $builder->join('m_kegiatan', 'usulan.kd_kgiat = m_kegiatan.kdgiat', 'left');
        $builder->join('m_kro', 'usulan.kd_kro = m_kro.kdkro', 'left');
        $builder->join('m_ro', 'usulan.kd_ro = m_ro.kdro', 'left');
        $builder->join('k_pro_p', 'usulan.id_prop = k_pro_p.id_prop', 'left');
        $builder->join('m_kabkot', 'usulan.id_kabkot = m_kabkot.id', 'left');
        $builder->join('m_satuan', 'usulan.id_satuan = m_satuan.id_satuan', 'left');
        $builder->join('m_pendanaan', 'usulan.id_pendanaan = m_pendanaan.id_pendanaan', 'left');
        $builder->join('k_kawasan', 'usulan.id_kawasan = k_kawasan.kode_kawasan', 'left');
        // Tambahkan kondisi untuk filter jika parameter tidak null
        if ($id) {
            $builder->where('usulan.id_usulan', $id);
        }
        $query = $builder->get();
        return $query->getResult();
    }
}
