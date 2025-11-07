<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $this->template->load('/templates/main', '/pages/dashboard');
    }
}
