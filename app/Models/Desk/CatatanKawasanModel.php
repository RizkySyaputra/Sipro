<?php

namespace App\Models\Desk;

use CodeIgniter\Model;

class CatatanKawasanModel extends Model
{
    protected $table = 'catatan_kawasan';
    protected $primaryKey = 'id_catatan_desk';
    protected $allowedFields = ['id_catatan_desk', 'id_provinsi', 'catatan_desk'];
    protected $useTimestamps  = 'true';

    public function getCatatanbyProvinsi($id_provinsi)
    {
        $builder = $this->db->table('catatan_kawasan');
        $builder->select('catatan_desk');
        $builder->where('id_provinsi', $id_provinsi);
        $query = $builder->get();
        $result = $query->getRow();
        return $result ? $result->catatan_desk : '';
    }

    public function addCatatan($id_provinsi, $catatan)
    {
        $builder = $this->db->table('catatan_kawasan');
        $data = [
            'id_provinsi' => $id_provinsi,
            'catatan_desk' => $catatan
        ];
        $builder->insert($data);
    }
    public function editCatatan($id_provinsi, $catatan)
    {
        $builder = $this->db->table('catatan_kawasan');
        $data = [
            'id_provinsi' => $id_provinsi,
            'catatan_desk' => $catatan
        ];
        $builder->where('id_provinsi', $id_provinsi);
        $builder->update($data);
    }
}
