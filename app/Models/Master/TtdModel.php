<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class TtdModel extends Model
{
    protected $table      = 'm_tanda_tangan'; // Replace with your table name
    protected $primaryKey = 'id';

    // Define allowed fields for mass assignment
    protected $allowedFields = [
        'pejabat_id',
        'tanda_tangan'
    ];

    // Enable timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
