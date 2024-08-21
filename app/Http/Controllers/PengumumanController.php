<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengumumanController extends Controller
{
    public function index()
    {
        $title = "pengumuman";
        $data = Pengumuman::where(function($query) {
            if (Auth::user()->role == "ukm") {
                $query->where('ukm_id', Auth::user()->ukm_id);
            }
        })
        ->latest()
        ->get();

        return view('back.pages.pengumuman', compact('title', 'data'));
    }

    public function simpan(Request $request, $id = null)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'judul' => 'required',
                'isi' => 'required',
            ]);

            if ($id != null) {
                $pengumuman = Pengumuman::findOrFail($id);
                $pengumuman->judul = $request->judul;
                $pengumuman->isi = $request->isi;
                if (!$pengumuman->update()) {
                    throw new \Exception("Terjadi kesalahan saat memperbarui data");
                }
            } else {
                $pengumuman = Pengumuman::create([
                    "judul" => $request->judul,
                    "isi" => $request->isi,
                    "ukm_id" => Auth::user()->ukm_id
                ]);
                if (!$pengumuman->save()) {
                    throw new \Exception("Gagal menambahkan data");
                }
            }

            DB::commit();

            return redirect()->back()->with("success", "Berhasil menyimpan data");

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function show($id = null)
    {
        $data = Pengumuman::findOrFail($id);

        try {
            return response()->json([
                'alert' => 1,
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            return response()->json([
                'alert' => 0,
                'message' => "Terjadi kesalahan: $message"
            ]);
        }
    }

    public function hapus(Request $request)
    {
        DB::beginTransaction();

        try {
            $pengumuman = Pengumuman::findOrFail($request->id);
            if (!$pengumuman->delete()) {
                throw new \Exception("Terjadi kesalahan saat menghapus data");
            }

            DB::commit();

            return redirect()->back()->with("success", "Berhasil menghapus data");

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function tolak(Request $request)
    {
        DB::beginTransaction();

        try {
            $pengumuman = Pengumuman::findOrFail($request->id);
            $pengumuman->status = "ditolak";
            $pengumuman->alasan_tolak = $request->alasan_tolak;

            if (!$pengumuman->update()) {
                throw new \Exception("Terjadi kesalahan saat menolak data");
            }

            DB::commit();

            return redirect()->back()->with("success", "Berhasil menghapus data");

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function terima(Request $request)
    {
        DB::beginTransaction();

        try {
            $pengumuman = Pengumuman::findOrFail($request->id);
            $pengumuman->status = "diterima";

            if (!$pengumuman->update()) {
                throw new \Exception("Terjadi kesalahan saat menerima data");
            }

            DB::commit();

            return redirect()->back()->with("success", "Berhasil menghapus data");

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }
    }
}
