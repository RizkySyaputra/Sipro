<?php

namespace App\Controllers;

use App\Models\Master\RoleModel;
use App\Models\Master\PermissionModel;
use App\Models\Master\MenuModel;

class RoleController extends BaseController
{
    public function __construct()
    {
        helper('permission');
    }
    public function index()
    {
        $id_role = user()->id_role;
        $roleModel = new RoleModel();
        $data = [
            'roles' => $roleModel->findAll(),
            'can_view' => has_permission_menu($id_role, '/role', 'can_view'),
            'can_edit' => has_permission_menu($id_role, '/role', 'can_edit'),
            'can_delete' => has_permission_menu($id_role, '/role', 'can_delete')
        ];
        $this->template->write('title', 'Kategori User');
        $this->template->load('/templates/main', '/pages/master/role/role', $data);
    }

    public function permission($role_id)
    {
        $id_role = user()->id_role;
        $roleModel = new RoleModel();
        $permModel = new PermissionModel();
        $menuModel = new MenuModel();
        $role = $roleModel->where('id', $role_id)->first();
        // $menus = $menuModel->orderBy('parent_id ASC, id_menu ASC')->where('m_menu.is_active', 1)->findAll();
        $menus = $menuModel->orderBy('parent_id ASC, prioritas ASC')->where('m_menu.is_active', 1)->findAll();
        $permissions = $permModel->getPermissionsByRole($role_id);
        $permMap = [];

        foreach ($permissions as $p) {
            $permMap[$p['id_menu']] = $p;
        }

        $data = [
            'permMap' => $permMap,
            'id_role' => $role_id,
            'menus' => $menus,
            'role' => $role,
            'can_view' => has_permission_menu($id_role, '/role', 'can_view'),
            'can_edit' => has_permission_menu($id_role, '/role', 'can_edit'),
            'can_delete' => has_permission_menu($id_role, '/role', 'can_delete')
        ];
        $this->template->write('title', 'Pengaturan Menu');
        $this->template->load('/templates/main', '/pages/master/role/role_permission', $data);
    }

    public function editPermission($role_id)
    {
        $menuModel = new MenuModel();
        $permModel = new PermissionModel();
        $roleModel = new RoleModel();
        $id_role = user()->id_role;
        $menus = $menuModel->orderBy('parent_id ASC, prioritas ASC')->where('m_menu.is_active', 1)->findAll();
        $permissions = $permModel->getPermissionsByRole($role_id);
        $role = $roleModel->where('id', $role_id)->first();
        // Format: [menu_id => [can_view, can_edit, can_delete]]
        $permMap = [];
        foreach ($permissions as $p) {
            $permMap[$p['id_menu']] = $p;
        }
        $data = [
            'role_id' => $role_id,
            'menus' => $menus,
            'permMap' => $permMap,
            'role' => $role,
            'can_view' => has_permission_menu($id_role, '/role', 'can_view'),
            'can_edit' => has_permission_menu($id_role, '/role', 'can_edit'),
            'can_delete' => has_permission_menu($id_role, '/role', 'can_delete')
        ];


        $this->template->write('title', 'Pengaturan Akses');
        $this->template->load('/templates/main', '/pages/master/role/edit_permission', $data);
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
