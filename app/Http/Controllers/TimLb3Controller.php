<?php

namespace App\Http\Controllers;

use App\Models\PeriodeLaporan;
use Illuminate\Http\Request;

class TimLb3Controller extends Controller
{
    public function index()
    {
        return view('dashboard.timlb3.index',);
    }
    public function showFormLimbahMasuk()
    {
        return view('dashboard.timlb3.formperiode');
    }

    public function submitFormKuartalTahun(Request $request)
    {
        $request->validate([
            'kuartal' => 'required|string|in:1,2,3,4',
            'tahun' => 'required|numeric|min:4',
        ]);

        $kuartalKeterangan = [
            '1' => 'Januari - Maret',
            '2' => 'April - Juni',
            '3' => 'Juli - September',
            '4' => 'Oktober - Desember',
        ];

        $periode = new PeriodeLaporan();
        $periode->kuartal = $request->input('kuartal');
        $periode->tahun = $request->input('tahun');
        $periode->keterangan_kuartal = $kuartalKeterangan[$request->input('kuartal')];
        $periode->save();

        return redirect()->route('timlb3.showFormLimbahMasuk')->with('success', 'Periode berhasil ditambahkan.');
    }
}
