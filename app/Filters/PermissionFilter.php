<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\Master\PermissionModel;
use App\Models\Master\MenuModel;

class PermissionFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

        $roleId = user()->id_role;
        if (!$roleId) {
            return redirect()->to('/forbidden');
        }

        $request = service('request');
        $currentlink = $request->getPath();
        $currentlink = preg_replace('#^keterpaduanprogram/#', '', $currentlink);
        $currentlink = '/' . ltrim($currentlink, '/');

        $menuModel = new MenuModel();
        $menu = $menuModel->where('link', $currentlink)->first();
        if (!$menu) {
            return redirect()->to('/forbidden');
        }

        $permModel = new PermissionModel();
        $permission = $permModel->where([
            'id_role' => $roleId,
            'id_menu' => $menu['id_menu']
        ])->first();

        if (!$permission) {
            d($permission);
            return redirect()->to('/forbidden');
        }
        if (empty($arguments)) {
            $arguments = ['view']; // default
        }
        // Cek sesuai argumen (misalnya view, edit, delete)
        if ($arguments) {
            foreach ($arguments as $arg) {
                if (empty($permission["can_$arg"]) || !$permission["can_$arg"]) {
                    return redirect()->to('/forbidden');
                }
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
