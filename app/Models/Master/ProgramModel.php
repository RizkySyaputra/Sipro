<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class ProgramModel extends Model
{
    protected $table = 'm_program';
    protected $allowedFields = ['kdprogram', 'nmprogram', 'tahun', 'id_unor'];
    protected $useTimestamps  = 'true';

    public function getProgram()
    {
        return $this->findAll();
    }
}
