<?php

namespace App\Models\Api;

use CodeIgniter\Model;

class ApiFkwModel extends Model
{
    protected $table = 'k_kegiatan_wajib_temp_api';
    protected $primaryKey = 'id_fkw';
    protected $useAutoIncrement = false;

    protected $allowedFields = [
        'id_fkw',
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
        'kode_kabkot',
        'lokasi',
        'rpm',
        'phln',
        'sbsn',
        'anggaran',
        'waktu_pelaksanaan',
        'id_pembiayaan',
        'catatan',
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
        $builder = $this->db->table('k_kegiatan_wajib as fkw');
        $builder->select('fkw.*, m_program.kdprogram, m_program.nmprogram, m_provinsi.*, m_unor.unor, m_pendanaan.sumber_pendanaan, m_satuan.nama_satuan,  ');
        $builder->join('m_provinsi', 'fkw.id_provinsi = m_provinsi.id', 'left');
        $builder->join('m_unor', 'fkw.id_unor = m_unor.id', 'left');
        $builder->join('m_pendanaan', 'fkw.id_pembiayaan = m_pendanaan.id_pendanaan', 'left');
        $builder->join('m_satuan', 'fkw.id_satuan = m_satuan.id_satuan', 'left');
        $builder->join('m_program', 'fkw.id_unor = m_program.id_unor', 'left');

        if ($id_provinsi) {
            $builder->where('fkw.id_provinsi', $id_provinsi);
        }
        if ($id_unor) {
            $builder->where('fkw.id_unor', $id_unor);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    public function getProgramFkwById($id_fkw)
    {
        $builder = $this->db->table('k_kegiatan_wajib as fkw');
        $builder->select('fkw.*, m_program.kdprogram, m_program.nmprogram, m_provinsi.*, m_unor.unor, m_pendanaan.sumber_pendanaan, m_satuan.nama_satuan ');
        $builder->join('m_provinsi', 'fkw.id_provinsi = m_provinsi.id', 'left');
        $builder->join('m_unor', 'fkw.id_unor = m_unor.id', 'left');
        $builder->join('m_pendanaan', 'fkw.id_pembiayaan = m_pendanaan.id_pendanaan', 'left');
        $builder->join('m_satuan', 'fkw.id_satuan = m_satuan.id_satuan', 'left');
        $builder->join('m_program', 'fkw.id_unor = m_program.id_unor', 'left');
        $builder->where('fkw.id_fkw', $id_fkw);
        $query = $builder->get();
        return $query->getResult();
    }
}
