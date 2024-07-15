<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
                "jurusan" => $request->jurusan,
                "angkatan" => $request->angkatan,
                "alamat" => $request->alamat,
                "password" => $request->password,
                "role" => "mahasiswa"
            ]);
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
                    return redirect()->intended('index');
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
}
