<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Login',
            'content' => 'v_login'
        ];
        return view('layout/v_wrapper', $data);
    }
}