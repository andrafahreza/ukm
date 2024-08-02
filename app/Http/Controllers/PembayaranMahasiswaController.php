<?php

namespace App\Http\Controllers;

use App\Models\PembayaranMahasiswa;
use App\Models\Ukm;
use App\Models\UkmUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PembayaranMahasiswaController extends Controller
{
    public function pembayaran()
    {
        $pembayaran = PembayaranMahasiswa::where('user_id', Auth::user()->id)->latest()->get();
        $ukmUser = UkmUser::where('user_id', Auth::user()->id)->get();

        return view('front.pembayaran', compact('pembayaran', 'ukmUser'));
    }

    public function bayar(Request $request)
    {
        DB::beginTransaction();

        try {
            $ukm = Ukm::findOrFail($request->ukm_id);

            $data = [
                "user_id" => Auth::user()->id,
                "ukm_id" => $ukm->id,
                "tujuan_pembayaran" => $request->tujuan_pembayaran,
                "tgl_bayar" => now(),
            ];

            $imageName = time().'.'.$request->bukti->extension();
            $request->bukti->move(public_path('/bukti'), $imageName);
            $data['bukti'] = "/$imageName";

            $bayar = PembayaranMahasiswa::create($data);

            if (!$bayar->save()) {
                throw new \Exception("Gagal melakukan pembayaran");
            }

            DB::commit();

            return redirect()->back()->with("success", "Berhasil melakukan pembayaran");

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    // Admin UKM
    public function validasi_pembayaran()
    {
        $title = "validasi_pembayaran";
        $data = PembayaranMahasiswa::latest()->get();

        return view('back.pages.validasi-pembayaran', compact('title', 'data'));
    }

    public function tolak(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();
            $pembayaran = PembayaranMahasiswa::where('ukm_id', $user->ukm_id)->findOrFail($request->id);

            $pembayaran->validasi = "ditolak";
            $pembayaran->keterangan = $request->keterangan;

            if (!$pembayaran->update()) {
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
            $pembayaran = PembayaranMahasiswa::where('ukm_id', $user->ukm_id)->findOrFail($request->id);

            $pembayaran->validasi = "diterima";
            if (!$pembayaran->update()) {
                throw new \Exception("Terjadi kesalahan saat memperbarui data");
            }

            DB::commit();

            return redirect()->back()->with("success", "Berhasil menyimpan data");
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }
    }
}
