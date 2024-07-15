<?php

namespace App\Http\Controllers;

use App\Models\Ukm;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        return view('front.index');
    }

    public function ukm()
    {
        $ukm = Ukm::get();

        return view('front.ukm', compact('ukm'));
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
