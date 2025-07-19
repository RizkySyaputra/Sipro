<?php

namespace App\Models\Konreg;

use CodeIgniter\Model;

class UnorFkwModel extends Model
{
    protected $table = 'k_kegiatan_wajib_temp_api';
    protected $primaryKey = 'id_fkw';

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
        $builder = $this->db->table('k_kegiatan_wajib_temp_api as fkw');
        $builder->select('fkw.*, m_ro.kdsatuan, m_program.kdprogram, m_program.nmprogram, m_provinsi.*, m_unor.unor, m_pendanaan.sumber_pendanaan, m_satuan.nama_satuan,  ');
        $builder->join('m_provinsi', 'fkw.id_provinsi = m_provinsi.id', 'left');
        $builder->join('m_unor', 'fkw.id_unor = m_unor.id', 'left');
        $builder->join('m_pendanaan', 'fkw.id_pembiayaan = m_pendanaan.id_pendanaan', 'left');
        $builder->join('m_ro', 'fkw.kd_ro = m_ro.kdro', 'left');
        $builder->join('m_satuan', 'm_ro.kdsatuan = m_satuan.id_satuan', 'left');
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
        $builder = $this->db->table('k_kegiatan_wajib_temp_api as fkw');
        $builder->select('fkw.*,m_tematik.tematik,m_kegiatan.nmgiat , m_kro.nmkro, m_ro.nmro, m_ro.kdsatuan, m_program.kdprogram, m_program.nmprogram, m_provinsi.*, m_unor.unor, m_pendanaan.sumber_pendanaan, m_satuan.nama_satuan ');
        $builder->join('m_provinsi', 'fkw.id_provinsi = m_provinsi.id', 'left');
        $builder->join('m_unor', 'fkw.id_unor = m_unor.id', 'left');
        $builder->join('m_pendanaan', 'fkw.id_pembiayaan = m_pendanaan.id_pendanaan', 'left');
        $builder->join('m_program', 'fkw.id_unor = m_program.id_unor', 'left');
        $builder->join('m_kegiatan', 'fkw.kd_kgiat = m_kegiatan.kdgiat', 'left');
        $builder->join('m_kro', 'fkw.kd_kro = m_kro.kdkro', 'left');
        $builder->join('m_ro', 'fkw.kd_ro = m_ro.kdro', 'left');
        $builder->join('m_satuan', ' m_ro.kdsatuan = m_satuan.id_satuan', 'left');
        $builder->join('m_tematik', 'fkw.id_tematik = m_tematik.id_tematik', 'left');
        $builder->where('fkw.id_fkw', $id_fkw);
        $query = $builder->get();
        return $query->getResult();
    }
    public function getProgramFkwById_sumber($id_sumber)
    {
        $builder = $this->db->table('k_kegiatan_wajib_temp_api as fkw');
        $builder->select('fkw.* ,m_tematik.tematik, m_kegiatan.nmgiat , m_kro.nmkro, m_ro.nmro, m_program.kdprogram, m_program.nmprogram, m_provinsi.*, m_unor.unor, m_pendanaan.sumber_pendanaan, m_satuan.nama_satuan ');
        $builder->join('m_provinsi', 'fkw.id_provinsi = m_provinsi.id', 'left');
        $builder->join('m_unor', 'fkw.id_unor = m_unor.id', 'left');
        $builder->join('m_pendanaan', 'fkw.id_pembiayaan = m_pendanaan.id_pendanaan', 'left');
        $builder->join('m_satuan', 'fkw.id_satuan = m_satuan.id_satuan', 'left');
        $builder->join('m_program', 'fkw.id_unor = m_program.id_unor', 'left');
        $builder->join('m_kegiatan', 'fkw.kd_kgiat = m_kegiatan.kdgiat', 'left');
        $builder->join('m_kro', 'fkw.kd_kro = m_kro.kdkro', 'left');
        $builder->join('m_ro', 'fkw.kd_ro = m_ro.kdro', 'left');
        $builder->join('m_tematik', 'fkw.id_tematik = m_tematik.id_tematik', 'left');
        $builder->where('fkw.id_sumber', $id_sumber);
        $query = $builder->get();
        return $query->getRow();
    }
}
