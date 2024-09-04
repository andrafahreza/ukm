<?php

namespace App\Http\Controllers;

use App\Models\UkmUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class LaporanController extends Controller
{
    public function cetakLaporanMahasiswa()
    {
        $data = UkmUser::with('user')->where('ukm_id', Auth::user()->ukm_id)->get();

        $pdf = PDF::loadView('back.pages.laporan.pdf.mahasiswa', [
            'data' => $data,
            'ukm' => Auth::user()->ukm->ukmNama
        ])
        ->setPaper('a4', 'landscape')
        ->setOptions(['isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true]);
        return $pdf->stream('laporan.pdf');
    }

    public function cetakKartu($id = null)
    {
        $data = UkmUser::with(['user', 'ukm'])->where('user_id', Auth::user()->id)->where('ukm_id', $id)->first();

        $pdf = PDF::loadView('back.pages.laporan.pdf.kartu', [
            'data' => $data,
            'logo' => url(asset($data->ukm->logo))
        ])
        ->setPaper('a4', 'landscape')
        ->setOptions(['isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true]);
        return $pdf->stream('laporan.pdf');
    }
}
