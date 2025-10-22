<?php

namespace App\Models\Rpiw;

use CodeIgniter\Model;

class DaftarRenaksiModel extends Model
{
    protected $table = 'view_rpiw_renaksi_2529';
    protected $primaryKey = 'id_renaksi';
    protected $returnType = 'object';


    public function getDaftarRenaksi($id_provinsi, $id_unor, $kawasan, $status = null)
    {
        $builder = $this->db->table('view_rpiw_renaksi_2529 as a');

        // SELECT clause
        $builder->select("a.*");
        // WHERE clause
        if ($id_provinsi) {
            $builder->where('a.id_provinsi', $id_provinsi);
        }
        if ($id_unor) {
            $builder->where('a.id_unor', $id_unor);
        }
        if ($kawasan) {
            $builder->where('a.kawasan', $kawasan);
        }
        if ($status !== null) {
            if ($status == 0) {
                $builder->where('a.mp', 0);
            } elseif ($status == 1) {
                $builder->where('a.mp >', 0);
            }
        }



        $builder->orderBy('a.id_renaksi', 'ASC');

        // Eksekusi
        $query = $builder->get();
        return $query->getResult();
    }
}
