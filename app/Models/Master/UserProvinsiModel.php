<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class UserProvinsiModel extends Model
{
    protected $table            = 'm_user_provinsi';
    protected $primaryKey       = 'id_trx';
    protected $allowedFields    = [
        'id_user',
        'id_provinsi',
        'created_at',
        'updated_at'
    ];
    public function getProvinsi($id_user)
    {
        $builder = $this->db->table('m_user_provinsi as a');
        $builder->select('a.id_user,b.id, b.provinsi');
        $builder->join('m_provinsi as b', 'a.id_provinsi = b.id', 'left');
        $builder->where('a.id_user', $id_user);
        $query = $builder->get();
        return $query->getResult();
    }

    protected $useTimestamps = true;
}
