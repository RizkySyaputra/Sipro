<?php

namespace App\Controllers;

use App\Models\Master\RoleModel;
use App\Models\Master\PermissionModel;
use App\Models\Master\MenuModel;

class RoleController extends BaseController
{
    public function index()
    {
        $roleModel = new RoleModel();
        $data['roles'] = $roleModel->findAll();
        return view('pages/master/role/role', $data);
    }

    public function permission($role_id)
    {
        $permModel = new PermissionModel();
        $data['permissions'] = $permModel->getPermissionsByRole($role_id);

        return view('pages/master/role/role_permission', $data);
    }

    public function editPermission($role_id)
    {
        $menuModel = new MenuModel();
        $permModel = new PermissionModel();

        $menus = $menuModel->orderBy('parent_id ASC, id_menu ASC')->findAll();
        $permissions = $permModel->where('id_role', $role_id)->findAll();

        // Format: [menu_id => [can_view, can_edit, can_delete]]
        $permMap = [];
        foreach ($permissions as $p) {
            $permMap[$p['id_menu']] = $p;
        }

        return view('pages/master/role/edit_permission', [
            'role_id' => $role_id,
            'menus' => $menus,
            'permMap' => $permMap,
        ]);
    }

    public function updatePermission($role_id)
    {
        $permModel = new PermissionModel();

        // Hapus permission lama untuk role ini
        $permModel->where('id_role', $role_id)->delete();

        // Ambil data dari form
        $menu_ids = $this->request->getPost('menu_ids');
        $view = $this->request->getPost('view') ?? [];
        $edit = $this->request->getPost('edit') ?? [];
        $delete = $this->request->getPost('delete') ?? [];

        $data = [];
        foreach ($menu_ids as $id) {
            $data[] = [
                'id_role' => $role_id,
                'id_menu' => $id,
                'can_view' => in_array($id, $view) ? 1 : 0,
                'can_edit' => in_array($id, $edit) ? 1 : 0,
                'can_delete' => in_array($id, $delete) ? 1 : 0,
            ];
        }
        $permModel->insertBatch($data);


        return redirect()->to('/role/permission/' . $role_id)->with('success', 'Akses berhasil diperbarui.');
    }
}
