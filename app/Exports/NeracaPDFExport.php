<?php

namespace App\Exports;

use App\Models\BulanModel;
use App\Models\NeracaLimbah1;
use App\Models\NeracaLimbah2;
use App\Models\PeriodeLaporan;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;

class NeracaPDFExport implements FromView
{
    use Exportable;

    private $idBulans;
    private $periode;

    public function __construct($periode, $idBulans)
    {
        $this->periode = $periode;
        $this->idBulans = $idBulans;
    }

    // NeracaPDFExport.php

    public function view(): View
    {
        // Ambil data Neraca 1 dan Neraca 2 berdasarkan id_bulan yang terhubung dengan periode
        $neraca1 = NeracaLimbah1::whereIn('id_bulan', $this->idBulans)->get();
        $neraca2 = NeracaLimbah2::whereIn('id_bulan', $this->idBulans)->first();
        $namaBulans = BulanModel::whereIn('id_bulan', $this->idBulans)->pluck('nama_bulan');
        $periode = $this->periode;

        // Kirim data ke tampilan Blade
        return view('export.neraca',  compact('neraca1', 'neraca2', 'namaBulans', 'periode'));
    }
    private function getBulanFromPeriode($id_periode)
    {
        // Logika untuk mendapatkan ID bulan dari ID periode
        // Misalnya, jika ID bulan disimpan di kolom tertentu di tabel periode
        $bulan_id = PeriodeLaporan::findOrFail($id_periode)->bulan_id;
        return BulanModel::findOrFail($bulan_id);
    }
}
