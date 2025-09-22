<?php
function has_permission_menu($roleId, $link, $action = 'view')
{

    $db = \Config\Database::connect();

    $permission = $db->table('m_permission')
        ->select($action)
        ->join('m_menu', 'm_menu.id_menu = m_permission.id_menu')
        ->where('m_permission.id_role', $roleId)
        ->where('m_menu.link', $link) // misalnya 'laporan'
        ->get()
        ->getRowArray();
    // Debug: tampilkan query yang dipakai

    return $permission && $permission[$action] == 1;
}
