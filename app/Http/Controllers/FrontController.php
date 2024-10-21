<?php

namespace App\Http\Controllers;

use App\Models\AgendaUkm;
use App\Models\Berita;
use App\Models\Dokumentasi;
use App\Models\Pengumuman;
use App\Models\PengurusUkm;
use App\Models\Prodi;
use App\Models\Ukm;
use App\Models\Video;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $ukm = Ukm::get();
        $dokumentasi = new Dokumentasi();

        $getvideo = Video::where('status', 'diterima')->get();
        $video = array();
        $kunci = 0;
        foreach ($getvideo as $key => $value) {
            if ($key == 2 || $key == 4 || $key == 6 || $key == 8 || $key == 10 || $key == 12) {
                $kunci ++;
            }

            $video[$kunci]['video'][] = $value;
        }
        $pengumuman = Pengumuman::where('status', 'diterima')->latest()->limit(8)->get();
        $berita = Berita::where('status', 'diterima')->latest()->limit(4)->get();
        $agenda = AgendaUkm::where('status', 'diterima')->latest()->limit(4)->get();

        return view('front.index', compact('dokumentasi', 'video', 'pengumuman', 'berita', 'agenda', 'ukm'));
    }

    public function pengumuman($id = null)
    {
        if ($id == null) {
            $pengumuman = Pengumuman::where('status', 'diterima')->get();

            return view('front.pengumuman', compact('pengumuman'));
        } else {
            $pengumuman = Pengumuman::findOrFail($id);

            return view('front.pengumuman-detail', compact('pengumuman'));
        }
    }

    public function berita($id = null)
    {
        if ($id == null) {
            $berita = Berita::where('status', 'diterima')->get();

            return view('front.berita', compact('berita'));
        } else {
            $berita = Berita::findOrFail($id);

            return view('front.berita-detail', compact('berita'));
        }
    }

    public function agenda($id = null)
    {
        if ($id == null) {
            $agenda = AgendaUkm::where('status', 'diterima')->get();

            return view('front.agenda', compact('agenda'));
        } else {
            $agenda = AgendaUkm::findOrFail($id);

            return view('front.agenda-detail', compact('agenda'));
        }
    }

    public function ukm($id = null)
    {
        if ($id == null) {
            $ukm = Ukm::get();

            return view('front.ukm', compact('ukm'));
        } else {
            $ukm = Ukm::findOrFail($id);
            $pengurus = PengurusUkm::where('ukm_id', $id)->first();

            return view('front.ukm-detail', compact('ukm', 'pengurus'));
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

    public function login_umum()
    {
        return view('back.login-umum');
    }

    public function register_umum()
    {
        return view('back.register-umum');
    }
}
