<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class ProgramModel extends Model
{
    protected $table = 'm_sk_program';

    protected $allowedFields = ['id_program', 'nm_program', 'periode', 'id_unor'];

    protected $useTimestamps  = 'true';

    public function getProgram()
    {
        return $this->findAll();
    }
}
