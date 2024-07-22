<?php

namespace App\Http\Controllers;

use App\Models\UkmUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UkmUserController extends Controller
{
    public function profil_mahasiswa()
    {
        $ukm = UkmUser::with('ukm')->where('user_id', Auth::user()->id)->latest()->get();

        return view('front.profil', compact('ukm'));
    }
}
