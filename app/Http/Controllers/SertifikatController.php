<?php

namespace App\Http\Controllers;

use App\Models\Sertifikat;
use App\Models\UkmUser;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SertifikatController extends Controller
{
    public function index()
    {
        $title = "sertifikat";
        $data = Sertifikat::where('ukm_id', Auth::user()->ukm_id)
        ->latest()
        ->get();

        $users = UkmUser::where('ukm_id', Auth::user()->ukm_id)->get();

        return view('back.pages.sertifikat', compact('title', 'data', 'users'));
    }

    public function simpan(Request $request, $id = null)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'file' => 'required|image|mimes:pdf,jpg,png,jpeg',
            ]);

            if ($id != null) {
                $sertifikat = Sertifikat::findOrFail($id);

                $imageName = time().'.'.$request->file->extension();
                $request->file->move(public_path('/sertifikat/'), $imageName);
                $dataFile= "/$imageName";

                File::delete(public_path($sertifikat->file));

                $sertifikat->file = $dataFile;
                $sertifikat->user_id = $request->user_id;
                $sertifikat->nama = $request->nama;
                if (!$sertifikat->update()) {
                    throw new \Exception("Terjadi kesalahan saat memperbarui data");
                }
            } else {
                $imageName = time().'.'.$request->file->extension();
                $request->file->move(public_path('/sertifikat/'), $imageName);
                $dataFile= "/$imageName";

                $sertifikat = Sertifikat::create([
                    "file" => $dataFile,
                    "nama" => $request->nama,
                    "user_id" => $request->user_id,
                    "ukm_id" => Auth::user()->ukm_id
                ]);
                if (!$sertifikat->save()) {
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
        $data = Sertifikat::find($id);
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
            $sertifikat = Sertifikat::findOrFail($request->id);
            File::delete(public_path($sertifikat->file));

            if (!$sertifikat->delete()) {
                throw new \Exception("Terjadi kesalahan saat menghapus data");
            }

            DB::commit();

            return redirect()->back()->with("success", "Berhasil menghapus data");

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    // Mahasiswa
    public function sertifikat_mahasiswa()
    {
        $ukmUser = UkmUser::select('ukm_id')->where('user_id', Auth::user()->id)->get();
        $sertifikat = Sertifikat::whereIn('ukm_id', $ukmUser)
            ->where('user_id', null)
            ->orWhere('user_id', Auth::user()->id)
            ->get();

        return view('front.sertifikat', compact('sertifikat'));
    }
}
