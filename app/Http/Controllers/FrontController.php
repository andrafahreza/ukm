<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        return view('front.index');
    }

    public function ukm()
    {
        return view('front.ukm');
    }

    public function login()
    {
        return view('back.login');
    }

    public function register()
    {
        return view('back.register');
    }
}
