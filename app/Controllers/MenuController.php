<?php

namespace App\Controllers;

use App\Models\Master\MenuModel;

class MenuController extends BaseController
{
    public function index()
    {
        helper('permission');
        $id_role = user()->id_role;
        $menuModel = new MenuModel();
        $menus = $menuModel->orderBy('parent_id ASC, id_menu ASC')->findAll();

        $data = [
            'menus' => $menus,
            'can_view' => has_permission_menu($id_role, '/menu', 'can_view'),
            'can_edit' => has_permission_menu($id_role, '/menu', 'can_edit'),
            'can_delete' => has_permission_menu($id_role, '/menu', 'can_delete')
        ];

        $this->template->write('title', 'Pengaturan Menu');
        $this->template->load('/templates/main', '/pages/master/menu', $data);
    }

    public function updateVisibilitas()
    {
        $menuModel = new MenuModel();

        // Ambil data dari form
        $menu_ids  = $this->request->getPost('menu_ids') ?? [];
        $is_active = $this->request->getPost('is_active') ?? [];

        if (!empty($menu_ids)) {
            foreach ($menu_ids as $id) {
                $status = in_array($id, $is_active) ? 1 : 0;
                $menuModel->update($id, ['is_active' => $status]);
            }
        }

        return redirect()->to('/menu')->with('success', 'Visibilitas menu berhasil diperbarui.');
    }
}
