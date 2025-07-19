<?php

namespace App\Models\Api;

use CodeIgniter\Model;

class ApiFkbModel extends Model
{
    protected $table = 'k_kegiatan_baru_temp_api';
    protected $primaryKey = 'id_fkb';
    protected $useAutoIncrement = false;

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
        'sumber'
    ];


    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getProgram($id_provinsi, $id_unor)
    {
        $builder = $this->db->table('k_kegiatan_baru as fkb');
        $builder->select('fkb.*, m_program.kdprogram, m_program.nmprogram, m_provinsi.*, m_unor.unor, m_pendanaan.sumber_pendanaan, m_satuan.nama_satuan,  ');
        $builder->join('m_provinsi', 'fkb.id_provinsi = m_provinsi.id', 'left');
        $builder->join('m_unor', 'fkb.id_unor = m_unor.id', 'left');
        $builder->join('m_pendanaan', 'fkb.id_pembiayaan = m_pendanaan.id_pendanaan', 'left');
        $builder->join('m_satuan', 'fkb.id_satuan = m_satuan.id_satuan', 'left');
        $builder->join('m_program', 'fkb.id_unor = m_program.id_unor', 'left');

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
        $builder->select('fkb.*, m_program.kdprogram, m_program.nmprogram, m_provinsi.*, m_unor.unor, m_pendanaan.sumber_pendanaan, m_satuan.nama_satuan ');
        $builder->join('m_provinsi', 'fkb.id_provinsi = m_provinsi.id', 'left');
        $builder->join('m_unor', 'fkb.id_unor = m_unor.id', 'left');
        $builder->join('m_pendanaan', 'fkb.id_pembiayaan = m_pendanaan.id_pendanaan', 'left');
        $builder->join('m_satuan', 'fkb.id_satuan = m_satuan.id_satuan', 'left');
        $builder->join('m_program', 'fkb.id_unor = m_program.id_unor', 'left');
        $builder->where('fkb.id_fkb', $id_fkb);
        $query = $builder->get();
        return $query->getResult();
    }
}
