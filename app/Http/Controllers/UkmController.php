<?php

namespace App\Http\Controllers;

use App\Models\PengurusUkm;
use App\Models\Prodi;
use App\Models\Ukm;
use App\Models\UkmUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

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
                "ketua" => $request->ketua,
                "ukmDeskripsi" => $request->ukmDeskripsi,
                "contact" => $request->contact,
                "tempat" => $request->tempat,
                "visi" => $request->visi,
                "misi" => $request->misi,
                "syarat" => $request->syarat,
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

    // Admin
    public function admin($id = null)
    {
        $title = "ukm";
        $ukm = Ukm::findOrFail($id);
        $user = User::where('ukm_id', $id)->latest()->get();
        $prodi = Prodi::get();

        return view('back.pages.admin-ukm', compact('ukm', 'user', 'title', 'prodi'));
    }

    public function admin_simpan(Request $request, $id = null)
    {
        DB::beginTransaction();

        try {
            $data = [
                "email" => $request->email,
                "nama_lengkap" => $request->nama_lengkap,
                "npm" => $request->npm,
                "jenis_kelamin" => $request->jenis_kelamin,
                "whatsapp" => $request->whatsapp,
                "angkatan" => $request->angkatan,
                "alamat" => $request->alamat,
                "role" => "ukm",
                "ukm_id" => $request->ukm_id,
                "prodi_id" => $request->prodi_id,
                "jurusan_id" => $request->jurusan_id,
            ];

            if ($id != null) {
                $user = User::find($id);
                if (empty($user)) {
                    throw new \Exception("User tidak ditemukan");
                }

                if (!$user->update($data)) {
                    throw new \Exception("Terjadi kesalahan saat memperbarui data");
                }
            } else {
                $data['password'] = Hash::make('password');

                $user = User::create($data);
                if (!$user->save()) {
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

    public function admin_show($id = null)
    {
        $data = User::findOrFail($id);

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

    public function admin_hapus(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = User::find($request->id);
            if (empty($user)) {
                throw new \Exception("Ukm tidak ditemukan");
            }

            if (!$user->delete()) {
                throw new \Exception("Terjadi kesalahan saat menghapus data");
            }

            DB::commit();

            return redirect()->back()->with("success", "Berhasil menghapus data");

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    // profil UKM
    public function profil_ukm()
    {
        $title = "profil_ukm";
        $user = Auth::user();
        $ukm = Ukm::findOrFail($user->ukm_id);
        $pengurus = PengurusUkm::where('ukm_id', $user->ukm_id)->first();

        return view('back.pages.profil-ukm', compact('title', "ukm", "pengurus"));
    }

    public function pengurus_simpan(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = [
                "ukm_id" => Auth::user()->ukm_id,
                "ketua_umum" => $request->ketua_umum,
                "wakil_ketua_umum" => $request->wakil_ketua_umum,
                "sekretaris" => $request->sekretaris,
                "wakil_sekretaris" => $request->wakil_sekretaris,
                "bendahara" => $request->bendahara,
                "wakil_bendahara" => $request->wakil_bendahara,
            ];

            $pengurus = PengurusUkm::where('ukm_id', Auth::user()->ukm_id)->first();
            if (empty($pengurus)) {
                $pengurus = PengurusUkm::create($data);
                if (!$pengurus->save()) {
                    throw new \Exception("Terjadi kesalahan dalam menyimpan data");
                }
            } else {
                if (!$pengurus->update($data)) {
                    throw new \Exception("Terjadi kesalahan saat memperbarui data");
                }
            }

            DB::commit();

            return redirect()->back()->with("success", "Berhasil menyimpan data");

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    // Anggota UKM
    public function anggota_ukm()
    {
        if (Auth::user()->role != "ukm") {
            abort(404);
        }

        $title = "anggota_ukm";
        $data = UkmUser::where('ukm_id', Auth::user()->ukm_id)->latest()->get();

        return view('back.pages.anggota-ukm', compact('title', 'data'));
    }
}
