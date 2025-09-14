<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Libraries\Template;
use App\Models\Master\MenuModel;
use App\Models\Master\UserModel;

abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;
    protected $template;
    protected $menuTree;

    /**
     * Helpers to be loaded automatically.
     *
     * @var list<string>
     */
    protected $helpers = ['menu', 'url'];

    /**
     * InitController
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->template = new \App\Libraries\Template();
        $userModel = new UserModel();
        $menuModel = new MenuModel();
        $id_user = user()->id;
        $id_role = $userModel->select('id_role')->where('id', $id_user)->first()['id_role'];
        // $id_role   = 1;
        $menuTree  = $menuModel->getMenuTreeByRole($id_role);

        // kirim ke semua view
        $this->template->write('menuTree', $menuTree);
    }


    /**
     * Render template utama
     *
     * @param string $view
     * @param array $data
     * @return string
     */
    protected function render(string $view, array $data = []): string
    {
        // Tambahkan menuTree ke semua view
        $data['menuTree'] = $this->menuTree;

        // Gabungkan konten utama ke layout
        return view('layout/main', $data + [
            'contents' => view($view, $data)
        ]);
    }
}
