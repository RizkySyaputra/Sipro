<?php

namespace App\Models\Konreg;

use CodeIgniter\Model;

class FkbModel extends Model
{
    protected $table = 'k_kegiatan_baru';
    protected $primaryKey = 'id_fkb';

    protected $allowedFields = [
        'id_fkb',
        'id_sumber',
        'tahun_diusulkan',
        'kd_prog',
        'kd_kgiat',
        'kd_kro',
        'kd_ro',
        'id_provinsi',
        'id_unor',
        'pekerjaan',
        'volume',
        'id_satuan',
        'id_kawasan',
        'id_kabkot',
        'lokasi',
        'anggaran',
        'tahun_pelaksanaan',
        'id_pembiayaan',
        'catatan',
        'renc_induk',
        'dok_renc_induk',
        'fs',
        'dok_fs',
        'ded',
        'dok_ded',
        'dokling',
        'dok_dokling',
        'lahan',
        'dok_lahan',
        'pasca_kons',
        'dok_pasca_kons',
        'terima_bantuan',
        'dok_terima_bantuan',
        'id_tematik',
        'geotag',
        'uraian_geotag',
        'sumber',
        'catatan_pradesk',
        'FKS',
        'catatan_desk',
        'no_prioritas',
    ];


    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getProgram($id_provinsi, $id_unor)
    {
        $builder = $this->db->table('k_kegiatan_baru as fkb');
        $builder->select('fkb.*,k_kawasan.nama_kawasan, m_program.kdprogram, m_program.nmprogram, m_provinsi.*, m_unor.unor, m_pendanaan.sumber_pendanaan, m_satuan.nama_satuan,  ');
        $builder->join('m_provinsi', 'fkb.id_provinsi = m_provinsi.id', 'left');
        $builder->join('m_unor', 'fkb.id_unor = m_unor.id', 'left');
        $builder->join('m_pendanaan', 'fkb.id_pembiayaan = m_pendanaan.id_pendanaan', 'left');
        $builder->join('m_satuan', 'fkb.id_satuan = m_satuan.id_satuan', 'left');
        $builder->join('m_program', 'fkb.id_unor = m_program.id_unor', 'left');
        $builder->join('k_kawasan', 'fkb.id_kawasan = k_kawasan.kode_kawasan', 'left');

        if ($id_provinsi) {
            $builder->where('fkb.id_provinsi', $id_provinsi);
        }
        if ($id_unor) {
            $builder->where('fkb.id_unor', $id_unor);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    public function getProgramFkbById($id_fkb)
    {
        $builder = $this->db->table('k_kegiatan_baru as fkb');
        $builder->select('fkb.*,m_tematik.tematik,m_kegiatan.nmgiat , m_kro.nmkro, m_ro.nmro, m_program.kdprogram, m_program.nmprogram, m_provinsi.*, m_unor.unor, m_pendanaan.sumber_pendanaan, m_satuan.nama_satuan ');
        $builder->join('m_provinsi', 'fkb.id_provinsi = m_provinsi.id', 'left');
        $builder->join('m_unor', 'fkb.id_unor = m_unor.id', 'left');
        $builder->join('m_pendanaan', 'fkb.id_pembiayaan = m_pendanaan.id_pendanaan', 'left');
        $builder->join('m_satuan', 'fkb.id_satuan = m_satuan.id_satuan', 'left');
        $builder->join('m_program', 'fkb.id_unor = m_program.id_unor', 'left');
        $builder->join('m_kegiatan', 'fkb.kd_kgiat = m_kegiatan.kdgiat', 'left');
        $builder->join('m_kro', 'fkb.kd_kro = m_kro.kdkro', 'left');
        $builder->join('m_ro', 'fkb.kd_ro = m_ro.kdro', 'left');
        $builder->join('m_tematik', 'fkb.id_tematik = m_tematik.id_tematik', 'left');
        $builder->where('fkb.id_fkb', $id_fkb);
        $query = $builder->get();
        return $query->getResult();
    }
    public function getProgramFkbById_sumber($id_sumber)
    {
        $builder = $this->db->table('k_kegiatan_baru as fkb');
        $builder->select('fkb.*,m_tematik.tematik,m_kegiatan.nmgiat , m_kro.nmkro, m_ro.nmro, m_program.kdprogram, m_program.nmprogram, m_provinsi.*, m_unor.unor, m_pendanaan.sumber_pendanaan, m_satuan.nama_satuan ');
        $builder->join('m_provinsi', 'fkb.id_provinsi = m_provinsi.id', 'left');
        $builder->join('m_unor', 'fkb.id_unor = m_unor.id', 'left');
        $builder->join('m_pendanaan', 'fkb.id_pembiayaan = m_pendanaan.id_pendanaan', 'left');
        $builder->join('m_satuan', 'fkb.id_satuan = m_satuan.id_satuan', 'left');
        $builder->join('m_program', 'fkb.id_unor = m_program.id_unor', 'left');
        $builder->join('m_kegiatan', 'fkb.kd_kgiat = m_kegiatan.kdgiat', 'left');
        $builder->join('m_kro', 'fkb.kd_kro = m_kro.kdkro', 'left');
        $builder->join('m_ro', 'fkb.kd_ro = m_ro.kdro', 'left');
        $builder->join('m_tematik', 'fkb.id_tematik = m_tematik.id_tematik', 'left');
        $builder->where('fkb.id_sumber', $id_sumber);
        $query = $builder->get();
        return $query->getRow();
    }
}
