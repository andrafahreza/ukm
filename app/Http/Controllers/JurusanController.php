<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JurusanController extends Controller
{
    public function index($id = null)
    {
        $title = "jurusan";
        $prodi = Prodi::findOrFail($id);
        $data = Jurusan::where('prodi_id', $id)->latest()->get();

        return view('back.pages.jurusan', compact('title', 'data', 'prodi'));
    }

    public function simpan(Request $request, $id = null)
    {
        DB::beginTransaction();

        try {
            $data = [
                "nama_jurusan" => $request->nama_jurusan,
                "prodi_id" => $request->prodi_id
            ];

            if ($id != null) {
                $jurusan = Jurusan::find($id);
                if (empty($jurusan)) {
                    throw new \Exception("Jurusan tidak ditemukan");
                }

                $check = Jurusan::where('nama_jurusan', $request->nama_jurusan)
                ->where('id', '!=', $id)
                ->where('prodi_id', $request->prodi_id)
                ->first();

                if (!empty($check)) {
                    throw new \Exception("Jurusan $request->nama_jurusan sudah terdaftar");
                }

                if (!$jurusan->update($data)) {
                    throw new \Exception("Terjadi kesalahan saat memperbarui data");
                }
            } else {
                $check = Jurusan::where('nama_jurusan', $request->nama_jurusan)
                ->where('prodi_id', $request->prodi_id)
                ->first();

                if (!empty($check)) {
                    throw new \Exception("Jurusan $request->nama_jurusan sudah terdaftar");
                }

                $jurusan = Jurusan::create($data);
                if (!$jurusan->save()) {
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
        $data = Jurusan::findOrFail($id);

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
            $jurusan = Jurusan::findOrFail($request->id);

            if (!$jurusan->delete()) {
                throw new \Exception("Terjadi kesalahan saat menghapus data");
            }

            DB::commit();

            return redirect()->back()->with("success", "Berhasil menghapus data");

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function get($id = null)
    {
        $data = Jurusan::where('prodi_id', $id)->get();

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
}
