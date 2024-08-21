<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BeritaController extends Controller
{
    public function index()
    {
        $title = "berita";
        $data = Berita::where(function($query) {
            if (Auth::user()->role == "ukm") {
                $query->where('ukm_id', Auth::user()->ukm_id);
            }
        })
        ->latest()
        ->get();

        return view('back.pages.berita', compact('title', 'data'));
    }

    public function simpan(Request $request, $id = null)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'judul' => 'required',
                'isi' => 'required',
                'foto' => 'required|image|mimes:jpg,png,jpeg'
            ]);

            if ($id != null) {
                $berita = Berita::findOrFail($id);
                $berita->judul = $request->judul;
                $berita->isi = $request->isi;

                $imageName = time().'.'.$request->foto->extension();
                $request->foto->move(public_path('/berita/'), $imageName);
                $dataFile= "/$imageName";

                File::delete(public_path($berita->foto));

                $berita->foto = $dataFile;
                if (!$berita->update()) {
                    throw new \Exception("Terjadi kesalahan saat memperbarui data");
                }
            } else {
                $imageName = time().'.'.$request->foto->extension();
                $request->foto->move(public_path('/berita/'), $imageName);
                $dataFile= "/$imageName";

                $berita = Berita::create([
                    "judul" => $request->judul,
                    "isi" => $request->isi,
                    "foto" => $dataFile,
                    "ukm_id" => Auth::user()->ukm_id
                ]);
                if (!$berita->save()) {
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
        $data = Berita::findOrFail($id);

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
            $berita = Berita::findOrFail($request->id);
            if (!$berita->delete()) {
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
            $berita = Berita::findOrFail($request->id);
            $berita->status = "ditolak";
            $berita->alasan_tolak = $request->alasan_tolak;

            if (!$berita->update()) {
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
            $berita = Berita::findOrFail($request->id);
            $berita->status = "diterima";
            File::delete(public_path($berita->file));

            if (!$berita->update()) {
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
