<?php

namespace App\Http\Controllers;

use App\Models\AgendaUkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AgendaUkmController extends Controller
{
    public function index()
    {
        $title = "agenda";
        $data = AgendaUkm::where(function($query) {
            if (Auth::user()->role == "ukm") {
                $query->where('ukm_id', Auth::user()->ukm_id);
            }
        })
        ->latest()
        ->get();

        return view('back.pages.agenda', compact('title', 'data'));
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
                $agenda = AgendaUkm::findOrFail($id);
                $agenda->judul = $request->judul;
                $agenda->isi = $request->isi;
                if (!$agenda->update()) {
                    throw new \Exception("Terjadi kesalahan saat memperbarui data");
                }
            } else {
                $agenda = AgendaUkm::create([
                    "judul" => $request->judul,
                    "isi" => $request->isi,
                    "ukm_id" => Auth::user()->ukm_id
                ]);
                if (!$agenda->save()) {
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
        $data = AgendaUkm::findOrFail($id);

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
            $agenda = AgendaUkm::findOrFail($request->id);
            if (!$agenda->delete()) {
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
            $agenda = AgendaUkm::findOrFail($request->id);
            $agenda->status = "ditolak";
            $agenda->alasan_tolak = $request->alasan_tolak;

            if (!$agenda->update()) {
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
            $agenda = AgendaUkm::findOrFail($request->id);
            $agenda->status = "diterima";

            if (!$agenda->update()) {
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
