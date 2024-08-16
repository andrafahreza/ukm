<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    public function index()
    {
        $title = "video";
        $data = Video::where(function($query) {
            if (Auth::user()->role == "ukm") {
                $query->where('ukm_id', Auth::user()->ukm_id);
            }
        })
        ->latest()
        ->get();

        return view('back.pages.video', compact('title', 'data'));
    }

    public function simpan(Request $request, $id = null)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'url' => 'required',
            ]);

            if ($id != null) {
                $video = Video::findOrFail($id);
                $video->url = $request->url;
                if (!$video->update()) {
                    throw new \Exception("Terjadi kesalahan saat memperbarui data");
                }
            } else {
                $video = Video::create([
                    "url" => $request->url,
                    "ukm_id" => Auth::user()->ukm_id
                ]);
                if (!$video->save()) {
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
        $data = Video::findOrFail($id);

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
            $video = Video::findOrFail($request->id);
            if (!$video->delete()) {
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
            $video = Video::findOrFail($request->id);
            $video->status = "ditolak";
            $video->alasan_tolak = $request->alasan_tolak;

            if (!$video->update()) {
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
            $video = Video::findOrFail($request->id);
            $video->status = "diterima";

            if (!$video->update()) {
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
