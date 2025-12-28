<?php

namespace App\Controllers;

use Myth\Auth\Controllers\AuthController as MythAuthController;

class AuthController extends MythAuthController
{
    /**
     * Override halaman register agar bisa diakses walaupun sudah login
     */

    public function register()
    {
        if (! logged_in()) {
            return redirect()->to(route_to('login'));
        }

        // Load data provinsi dan unor
        $provinsiModel = new \App\Models\Master\ProvinsiModel();
        $unorModel     = new \App\Models\Master\UnorModel();
        $roleModel = new \App\Models\Master\RoleModel();
        $data = [
            'config'   => $this->config,
            'provinsi' => $provinsiModel->findAll(),
            'unor'     => $unorModel->getUnor(),
            'role' => $roleModel->findAll(),
        ];
        // Hilangkan check "sudah login"
        // if (logged_in()) {
        //     return redirect()->to('/');
        // }

        return view($this->config->views['register'], $data);
    }

    /**
     * Override proses register
     */
    public function attemptRegister()
    {
        return parent::attemptRegister(); // tetap pakai logic dari Myth/Auth
    }
}
