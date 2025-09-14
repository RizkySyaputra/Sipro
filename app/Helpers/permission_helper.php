<?
function has_permission($roleId, $link, $action = 'view')
{
    $db = \Config\Database::connect();

    $permission = $db->table('m_permission')
        ->select($action)
        ->join('m_menu', 'm_menu.id_menu = permission.id_menu')
        ->where('permission.id_role', $roleId)
        ->where('menu.link', $link) // misalnya 'laporan'
        ->get()
        ->getRowArray();

    return $permission && $permission[$action] == 1;
}
