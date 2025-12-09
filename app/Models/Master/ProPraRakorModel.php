<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class ProPraRakorModel extends Model
{
    protected $table = 'prog_tahunan_pra_rakorbangwil';
    protected $useTimestamps = true;
    protected $allowedFields = ['catatan_pra_rakorbangwil', 'usulan_pekerjaan', 'catatan_kws_desk_rakorbangwil'];
}
