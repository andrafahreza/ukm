<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\UkmUser;
use App\Models\User;
use Illuminate\Support\Facades\File;
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

                if (Auth::user()->status == "nonactive") {
                    throw new \Exception("Akun anda dinonaktifkan, silahkan hubungi administrator untuk mengaktifkan kembali");
                }

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

            if ($request->photo) {
                $request->validate([
                    'photo' => 'required|image|mimes:jpeg,png,jpg',
                ]);

                $imageName = time().'.'.$request->photo->extension();
                $request->photo->move(public_path('/profile/'), $imageName);
                $data['photo'] = "profile/$imageName";

                File::delete(public_path($user->photo));
            }

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
        $data = User::whereNot('role', 'admin')->get();
        $prodi = Prodi::get();
        $jurusan = Jurusan::get();

        return view('back.pages.user', compact('title', 'data', 'prodi', 'jurusan'));
    }

    public function nonactive_user(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = User::findOrFail($request->id);
            $data->status = "nonactive";
            $data->update();

            DB::commit();

            return redirect()->back()->with("success", "Berhasil memperbarui password");
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function reset_user(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = User::findOrFail($request->id);
            $data->password = Hash::make("password");
            $data->update();

            DB::commit();

            return redirect()->back()->with("success", "Berhasil memperbarui password");
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function active_user(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = User::findOrFail($request->id);
            $data->status = "active";
            $data->update();

            DB::commit();

            return redirect()->back()->with("success", "Berhasil memperbarui password");
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function mahasiswa()
    {
        $title = "data_mahasiswa";
        $data = User::where('role', 'mahasiswa')
        ->where(function($query) {
            if (Auth::user()->role == "ukm") {
                $ukmUser = UkmUser::select('user_id')->where('ukm_id', Auth::user()->ukm_id)->get();
                $query->whereIn('id', $ukmUser);
            }
        })
        ->get();

        return view('back.pages.mahasiswa', compact('title', 'data'));
    }
}
