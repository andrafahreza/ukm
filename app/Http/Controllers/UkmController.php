<?php

namespace App\Http\Controllers;

use App\Models\Ukm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UkmController extends Controller
{
    public function index()
    {
        $title = "ukm";
        $data = Ukm::latest()->get();

        return view('back.pages.ukm', compact('title', 'data'));
    }

    public function simpan(Request $request, $id = null)
    {
        DB::beginTransaction();

        try {
            $data = [
                "ukmNama" => $request->ukmNama,
                "ukmDeskripsi" => $request->ukmDeskripsi,
                "contact" => $request->contact
            ];

            if ($id != null) {
                $ukm = Ukm::find($id);
                if (empty($ukm)) {
                    throw new \Exception("Ukm tidak ditemukan");
                }

                if ($request->logo != null) {
                    $request->validate([
                        'logo' => 'required|image|mimes:jpeg,png,jpg',
                    ]);

                    $imageName = time().'.'.$request->logo->extension();
                    $request->logo->move(public_path('/'), $imageName);
                    $data['logo'] = "/$imageName";

                    File::delete(public_path($ukm->logo));
                }

                if (!$ukm->update($data)) {
                    throw new \Exception("Terjadi kesalahan saat memperbarui data");
                }
            } else {
                $request->validate([
                    'logo' => 'required|image|mimes:jpeg,png,jpg',
                ]);

                $cekUkm = Ukm::where('ukmNama', $request->ukmNama)->first();
                if (!empty($cekUkm)) {
                    throw new \Exception("Ukm dengan nama $request->ukmNama sudah terdaftar");
                }

                $imageName = time().'.'.$request->logo->extension();
                $request->logo->move(public_path('/'), $imageName);
                $data['logo'] = "/$imageName";

                $ukm = Ukm::create($data);
                if (!$ukm->save()) {
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
        $data = Ukm::find($id);
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
            $ukm = Ukm::find($request->id);
            if (empty($ukm)) {
                throw new \Exception("Ukm tidak ditemukan");
            }

            File::delete(public_path($ukm->logo));

            if (!$ukm->delete()) {
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
