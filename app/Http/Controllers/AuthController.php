<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = User::create([
                "email" => $request->email,
                "nama_lengkap" => $request->nama_lengkap,
                "npm" => $request->npm,
                "jenis_kelamin" => $request->jenis_kelamin,
                "whatsapp" => $request->whatsapp,
                "angkatan" => $request->angkatan,
                "alamat" => $request->alamat,
                "password" => Hash::make($request->password),
                "role" => "mahasiswa",
                'prodi_id' => $request->prodi_id,
                'jurusan_id' => $request->jurusan_id,
            ]);

            if (!$data->save()) {
                throw new \Exception("Terjadi kesalahan dalam menyimpan data");
            }

            DB::commit();

            return redirect()->route('login')->with("success", "Berhasil melakukan pendaftaran akun, silahkan login");
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function auth(Request $request)
    {
        try {
            $credentials = $request->validate([
                "email" => 'required',
                "password" => 'required'
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                if (Auth::user()->role != "mahasiswa") {
                    return redirect()->intended("home");
                } else {
                    return redirect()->intended('/');
                }
            }

            throw new \Exception("Email atau password salah");

        } catch (\Throwable $th) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->back()->withErrors(['message' => $th->getMessage()]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function update_profil_mahasiswa(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = [
                "nama_lengkap" => $request->nama_lengkap,
                "jenis_kelamin" => $request->jenis_kelamin,
                "whatsapp" => $request->whatsapp,
                "angkatan" => $request->angkatan,
                "alamat" => $request->alamat,
            ];

            $user = Auth::user();

            if (!$user->update($data)) {
                throw new \Exception("Terjadi kesalahan dalam menyimpan data");
            }

            DB::commit();

            return redirect()->back()->with("success", "Berhasil update data profil");
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function ganti_password_mahasiswa(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();
            $checkOldPassword = Hash::check($request->old_password, $user->password);
            if (!$checkOldPassword) {
                throw new \Exception("Password lama salah");
            }

            if ($request->new_password != $request->konfirmasi_password) {
                throw new \Exception("Password baru dan konfirmasi password harus sama");
            }

            $user->password = Hash::make($request->new_password);

            if (!$user->update()) {
                throw new \Exception("Terjadi kesalahan saat memperbarui password");
            }

            DB::commit();

            return redirect()->back()->with("success", "Berhasil memperbarui password");

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function user()
    {
        $title = "data_user";
        $data = User::get();

        return view('back.pages.user', compact('title', 'data'));

    }
}
