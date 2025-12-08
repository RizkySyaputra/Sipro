<?php

namespace App\Models\Rakorbangwil;

use CodeIgniter\Model;

class PejabatBakModel extends Model
{
    protected $table            = 'm_ttd_ba_rakorbangwil';
    protected $useAutoIncrement = true;
    protected $primaryKey       = 'id';

    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'id',
        'id_pejabat',
        'id_provinsi',
        'id_desk',
        'id_pn',
        'prioritas',
        'thn_pelaksanaan'
    ];


    protected $useTimestamps = true;
    protected $createdField  = 'created_at';  // pastikan ada di tabel
    protected $updatedField  = 'updated_at';  // pastikan ada di tabel
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
}
