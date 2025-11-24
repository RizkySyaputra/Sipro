<?php

namespace App\Controllers;

use App\Models\Master\UserModel;

class ProfileController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $userId = user()->id;
        $dataUser = $this->userModel->getUserById($userId);

        $data = [
            'user'  => $dataUser
        ];

        $this->template->load('/templates/main', '/pages/profile/index', $data);
    }
}
