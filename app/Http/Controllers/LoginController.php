<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin/login');
    }

    public function action_login()
    {

    }

    public function admin_index()
    {
        return view('admin/index');
    }
}
