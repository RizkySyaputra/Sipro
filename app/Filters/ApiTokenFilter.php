<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class ApiTokenFilter implements FilterInterface
{
    // Token mapping
    protected $validTokens = [
        'XAPI-728F3A9C-B1C7-41E0-944A-57F2E8A6C045' => 'SDA',
        'XAPI-3A92FDC1-7BF3-4F88-AE30-91E8DC66F7D1' => 'BM',
        'XAPI-5C1AB480-2E2F-4D89-B9C6-0FD8B7B746AB' => 'CK'
    ];

    public function before(RequestInterface $request, $arguments = null)
    {
        $header = $request->getHeaderLine('Authorization');

        if (!$header) {
            return service('response')->setStatusCode(401)
                ->setJSON(['status' => false, 'message' => 'Token required']);
        }

        $token = trim($header);

        if (!array_key_exists($token, $this->validTokens)) {
            return service('response')->setStatusCode(401)
                ->setJSON(['status' => false, 'message' => 'Invalid Token']);
        }

        // Simpan info client (misalnya ke request attribute)
        $request->client = (object)[
            'token' => $token,
            'type'  => $this->validTokens[$token]
        ];
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
