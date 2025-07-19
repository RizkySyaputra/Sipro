<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class PejabatModel extends Model
{
    protected $table      = 'm_pejabat'; // Replace with your table name
    protected $primaryKey = 'id_pejabat';

    // Define allowed fields for mass assignment
    protected $allowedFields = [
        'nip',
        'nama_pejabat',
        'jabatan',
        'unit_kerja',
        'unit_organisasi',
        'instansi',
        'email',
        'no_telp',
        'tanda_tangan'
    ];

    // Enable timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getPejabat()
    {
        return $this->findAll(); // Fetch all rows from the `pejabat` table
    }
    public function getPejabatbyId($id_pejabat)
    {
        $builder = $this->db->table('m_pejabat');
        $builder->select('*');
        $builder->where('id_pejabat', $id_pejabat);
        $query = $builder->get();
        return $query->getResult(); // Fetch all rows from the `pejabat` table
    }
    // //gaperlu
    // public function getTtdPejabat()
    // {
    //     $builder = $this->db->table('m_pejabat as mj');
    //     $builder->select('mj.*, mt.*');
    //     $builder->join('m_tanda_tangan as mt', 'mj.id_pejabat = mt.pejabat_id', 'left');
    //     $query = $builder->get();
    //     return $query->getResult();
    // }
}
