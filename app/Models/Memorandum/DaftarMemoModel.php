<?php

namespace App\Models\Memorandum;

use CodeIgniter\Model;

class DaftarMemoModel extends Model
{
    protected $table = 'view_prog_memorandum_2529';
    protected $primaryKey = 'id_memorandum';
    protected $returnType = 'object';


    public function getDaftarMemo($id_provinsi, $id_unor, $sumber, $pn)
    {
        $builder = $this->db->table('view_prog_memorandum_2529 as a');

        // SELECT clause
        $builder->select("a.*");
        // WHERE clause
        if ($id_provinsi) {
            $builder->where('a.id_provinsi', $id_provinsi);
        }
        if ($id_unor) {
            $builder->where('a.id_unor', $id_unor);
        }
        if ($sumber) {
            $builder->where('a.sumber', $sumber);
        }
        if ($pn) {
            if ($pn == "NON") {
                $builder->where('a.id_pn', null);
            } else {
                $builder->where('a.id_pn', $pn);
            }
        }
        $builder->orderBy('a.id_memorandum', 'ASC');

        // Eksekusi
        $query = $builder->get();
        return $query->getResult();
    }
}
