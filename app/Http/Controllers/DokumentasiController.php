<?php

namespace App\Http\Controllers;

use App\Models\Dokumentasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DokumentasiController extends Controller
{
    public function index()
    {
        $title = "dokumentasi";
        $data = Dokumentasi::latest()
        ->get();

        return view('back.pages.dokumentasi', compact('title', 'data'));
    }

    public function simpan(Request $request, $id = null)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'file' => 'required|image|mimes:jpg,png,jpeg',
            ]);

            if ($id != null) {
                $dokumentasi = Dokumentasi::findOrFail($id);

                $imageName = time().'.'.$request->file->extension();
                $request->file->move(public_path('/dokumentasi/'), $imageName);
                $dataFile= "/$imageName";

                File::delete(public_path($dokumentasi->file));

                $dokumentasi->file = $dataFile;
                if (!$dokumentasi->update()) {
                    throw new \Exception("Terjadi kesalahan saat memperbarui data");
                }
            } else {
                $imageName = time().'.'.$request->file->extension();
                $request->file->move(public_path('/dokumentasi/'), $imageName);
                $dataFile= "/$imageName";

                $dokumentasi = Dokumentasi::create([
                    "file" => $dataFile,
                ]);

                if (!$dokumentasi->save()) {
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
        $data = Dokumentasi::find($id);
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
            $dokumentasi = Dokumentasi::findOrFail($request->id);
            File::delete(public_path($dokumentasi->file));

            if (!$dokumentasi->delete()) {
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
