<?php

namespace App\Http\Controllers;

use App\Models\UkmUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $title = 'dashboard';
        $mahasiswa = UkmUser::where('ukm_id', Auth::user()->ukm_id)->get();

        return view('back.index', compact('title', 'mahasiswa'));
    }
}
