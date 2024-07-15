<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdiController extends Controller
{
    public function index()
    {
        $title = "prodi";
        $data = Prodi::latest()->get();

        return view('back.pages.prodi', compact('title', 'data'));
    }

    public function simpan(Request $request, $id = null)
    {
        DB::beginTransaction();

        try {
            $data = [
                "nama_prodi" => $request->nama_prodi
            ];

            if ($id != null) {
                $prodi = Prodi::find($id);
                if (empty($prodi)) {
                    throw new \Exception("Prodi tidak ditemukan");
                }

                $check = Prodi::where('nama_prodi', $request->nama_prodi)->where('id', '!=', $id)->first();
                if (!empty($check)) {
                    throw new \Exception("Prodi $request->nama_prodi sudah terdaftar");
                }

                if (!$prodi->update($data)) {
                    throw new \Exception("Terjadi kesalahan saat memperbarui data");
                }
            } else {
                $check = Prodi::where('nama_prodi', $request->nama_prodi)->first();
                if (!empty($check)) {
                    throw new \Exception("Prodi $request->nama_prodi sudah terdaftar");
                }

                $prodi = Prodi::create($data);
                if (!$prodi->save()) {
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
        $data = Prodi::find($id);
        if ($data == null || $id == null) {
            abort(404);
        }

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
            $prodi = Prodi::find($request->id);
            if (empty($prodi)) {
                throw new \Exception("Prodi tidak ditemukan");
            }

            if (!$prodi->delete()) {
                throw new \Exception("Terjadi kesalahan saat menghapus data");
            }

            DB::commit();

            return redirect()->back()->with("success", "Berhasil menghapus data");

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }
    }
}
