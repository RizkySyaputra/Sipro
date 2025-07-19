<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        $this->template->load('/templates/start', 'login');
    }
}
