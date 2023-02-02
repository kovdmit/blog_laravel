<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function regCreate()
    {
        return view('user.register');
    }

    public function regStore()
    {
        //
    }

    public function authCreate()
    {
        return view('user.login');
    }

    public function authStore()
    {
        //
    }

    public function logout()
    {
        //
    }
}
