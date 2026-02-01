<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function test()
    {
        return view('user.test');
    }

    // /user/lk
    public function lk()
    {
        echo 'user/lk';
        die;
    }
}
