<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'm_menu';
    protected $primaryKey = 'id_menu';
    protected $allowedFields = [
        'id_menu',
        'nama_menu',
        'parent_id',
        'link',
        'level',
        'id_tipe',
        'tipe',
        'is_active'
    ];
    protected $useTimestamps = true;

    public function getAllMenu()
    {
        return $this->orderBy('id_menu', 'ASC')->findAll();
    }

    public function getMenuTreeByRole($role_id, $parent_id = 0)
    {
        // $priority_id = 74; // Menu dashboard

        $builder = $this->db->table('m_menu m')
            ->select('m.*, p.can_view, p.can_edit, p.can_delete')
            ->join('m_permission p', 'p.id_menu = m.id_menu')
            ->where('p.id_role', $role_id)
            ->where('p.can_view', 1)
            ->where('m.parent_id', $parent_id)
            ->where('m.is_active', 1)
            // ->orderBy("CASE WHEN m.id_menu = $priority_id THEN 0 ELSE 1 END", 'ASC', false)

            // ->orderBy('m.id_menu', 'ASC') 
            ->orderBy('m.prioritas', 'ASC')
            ->orderBy('m.id_menu', 'ASC')

            ->get()->getResultArray();

        $tree = [];
        foreach ($builder as $row) {
            $children = $this->getMenuTreeByRole($role_id, $row['id_menu']);
            if ($children) {
                $row['children'] = $children;
            }
            $tree[] = $row;
        }

        return $tree;
    }
}
