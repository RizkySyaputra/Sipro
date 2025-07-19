<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class ProvinsiModel extends Model
{
    protected $table = 'm_provinsi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'provinsi', 'latitude', 'longitude', 'ibu_kota'];
    protected $useTimestamps  = 'true';

    public function getProvinsi()
    {
        $builder = $this->db->table('m_provinsi');
        $builder->select('m_provinsi.*');
        $builder->orderBy('id', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getCatatanProvinsibyId($id_provinsi)
    {
        $builder = $this->db->table('m_provinsi');
        $builder->select('catatan_kawasan');
        $builder->where('id', $id_provinsi);
        $query = $builder->get();
        $result = $query->getRow();
        return $result ? $result->catatan_kawasan : '';
    }
    public function addCatatanProvinsi($id_provinsi, $catatan)
    {

        $builder = $this->db->table('m_provinsi');
        $data = [
            'catatan_kawasan' => $catatan
        ];
        $builder->where('id', $id_provinsi);
        $builder->update($data);
    }
}
