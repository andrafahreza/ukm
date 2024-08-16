<?php

namespace App\Http\Controllers;

use App\Models\Dokumentasi;
use App\Models\Prodi;
use App\Models\Ukm;
use App\Models\Video;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $dokumentasi = Dokumentasi::get();
        $getvideo = Video::where('status', 'diterima')->get();
        $video = array();
        foreach ($getvideo as $key => $value) {
            $kunci = 0;
            if ($key == 3 || $key == 6 || $key == 9 || $key == 12 || $key == 15 || $key == 18) {
                $kunci ++;
            }

            $video[$kunci]['video'][] = $value;
        }

        return view('front.index', compact('dokumentasi', 'video'));
    }

    public function ukm($id = null)
    {
        if ($id == null) {
            $ukm = Ukm::get();

            return view('front.ukm', compact('ukm'));
        } else {
            $ukm = Ukm::findOrFail($id);

            return view('front.ukm-detail', compact('ukm'));
        }
    }

    public function login()
    {
        return view('back.login');
    }

    public function register()
    {
        $prodi = Prodi::get();

        return view('back.register', compact('prodi'));
    }
}
