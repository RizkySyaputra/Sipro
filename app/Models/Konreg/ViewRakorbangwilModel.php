<?php

namespace App\Models\Konreg;

use CodeIgniter\Model;

class ViewRakorbangwilModel extends Model
{
    protected $table = 'view_hasil_rakorbangwil';


    public function getProgramMemo($id_provinsi, $id_unor,  $sumber = null, $kesepakatan = null)
    {
        $builder = $this->db->table('view_hasil_rakorbangwil as a');
        $builder->select("a.*");
        if ($id_provinsi) {
            $builder->where('a.id_provinsi', $id_provinsi);
        }
        if ($id_unor) {
            $builder->where('a.id_unor', $id_unor);
        }
        if ($sumber) {
            $builder->where('a.sumber', $sumber);
        }
        if ($kesepakatan) {
            $builder->where('a.kesepakatan', $kesepakatan);
        }
    }
}
