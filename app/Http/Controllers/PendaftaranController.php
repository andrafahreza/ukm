<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Ukm;
use App\Models\UkmUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PendaftaranController extends Controller
{
    public function index()
    {
        $ukm = Ukm::get();
        $pendaftaran = Pendaftaran::with('ukm')->latest()->get();

        return view('front.pendaftaran', compact('ukm', 'pendaftaran'));
    }

    public function daftar(Request $request)
    {
        DB::beginTransaction();

        try {
            $ukm = Ukm::findOrFail($request->ukm_id);

            $cekUkm = UkmUser::where('ukm_id', $request->ukm_id)->where('user_id', Auth::user()->id)->first();
            if (!empty($cekUkm)) {
                throw new \Exception("Kamu sudah terdaftar di ukm $ukm->ukmNama");
            }

            $cekPendaftaran = Pendaftaran::where('ukm_id', $request->ukm_id)
            ->where('user_id', Auth::user()->id)
            ->where('status', 'menunggu')
            ->first();
            if (!empty($cekPendaftaran)) {
                throw new \Exception("Kamu sudah melakukan pendaftaran di ukm $ukm->ukmNama");
            }

            $data = [
                "ukm_id" => $request->ukm_id,
                "alasan" => $request->alasan,
                "user_id" => Auth::user()->id
            ];

            $imageName = time().'.'.$request->foto->extension();
            $request->foto->move(public_path('/foto_pendaftar'), $imageName);
            $data['foto'] = "/$imageName";

            $pendaftaran = Pendaftaran::create($data);
            if (!$pendaftaran->save()) {
                throw new \Exception("Gagal melakukan pendaftaran");
            }

            DB::commit();

            return redirect()->back()->with("success", "Berhasil melakukan pendaftaran");

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function list()
    {
        $title = "data_pendaftaran";
        $user = Auth::user();
        $data = Pendaftaran::with(['ukm', 'user'])
        ->where(function($query) use($user) {
            if ($user->role == "ukm") {
                $query->where('ukm_id', $user->ukm_id);
            }
        })
        ->latest()
        ->get();

        return view('back.pages.pendaftar', compact('title', 'data'));
    }

    public function tolak(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();
            $pendaftaran = Pendaftaran::where('ukm_id', $user->ukm_id)->findOrFail($request->id);

            $pendaftaran->status = "ditolak";
            $pendaftaran->alasan_tolak = $request->alasan_tolak;

            if (!$pendaftaran->update()) {
                throw new \Exception("Terjadi kesalahan saat memperbarui data");
            }

            DB::commit();

            return redirect()->back()->with("success", "Berhasil menyimpan data");
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function terima(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();
            $pendaftaran = Pendaftaran::where('ukm_id', $user->ukm_id)->findOrFail($request->id);

            $pendaftaran->status = "diterima";
            if (!$pendaftaran->update()) {
                throw new \Exception("Terjadi kesalahan saat memperbarui data");
            }

            $mahasiswa = User::findOrFail($request->user_id);
            $ukmUser = UkmUser::create([
                'user_id' => $request->user_id,
                "ukm_id" => $pendaftaran->ukm_id
            ]);

            if (!$ukmUser->save()) {
                throw new \Exception("Gagal menambah data ke ukm, mohon coba lagi");
            }

            DB::commit();

            return redirect()->back()->with("success", "Berhasil menyimpan data");
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }
    }
}
