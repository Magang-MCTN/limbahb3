<?php

namespace App\Http\Controllers;

use App\Exports\LimbahKeluarExport;
use App\Models\PeriodeLaporan;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LimbahMasukExport;
use App\Exports\NeracaExport;
use App\Exports\NeracaPDFExport;
use App\Models\BulanModel;
use App\Models\NeracaLimbah1;
use App\Models\NeracaLimbah2;
use App\Models\TandaTangan;
use PDF;
use Illuminate\Support\Facades\View;

class ExportController extends Controller
{
    public function exportLimbahMasuk($id_periode_laporan)
    {
        $periode = PeriodeLaporan::findOrFail($id_periode_laporan);
        $limbahMasuk = $periode->limbahMasuk;

        // Buat judul sesuai kebutuhan
        $judul = 'PT. MANDAU CIPTA TENAGA NUSANTARA - NORTH DURI COGEN (' . date('Y') . ')';

        // Inisialisasi kelas eksport dengan judul dan data Limbah Masuk
        $export = new LimbahMasukExport($judul, $limbahMasuk);

        // Export dengan nama file tertentu (opsional)
        return Excel::download($export, 'limbah_masuk.xlsx');
    }


    public function exportLimbahKeluar($id_periode_laporan)
    {
        $periode = PeriodeLaporan::findOrFail($id_periode_laporan);
        $limbahKeluar = $periode->limbahKeluar;
        $tandaTangan = TandaTangan::first();

        $judul = 'PT. MANDAU CIPTA TENAGA NUSANTARA - NORTH DURI COGEN (' . date('Y') . ')';
        $export = new LimbahKeluarExport($judul, $limbahKeluar, $tandaTangan);

        return Excel::download($export, 'limbah_keluar.xlsx');
    }
    public function exportNeraca($id_periode_laporan)
    {
        return Excel::download(new NeracaExport($id_periode_laporan), 'neraca.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }
    // public function exportNeracaPDF($id_periode_laporan)
    // {
    //     $periode = PeriodeLaporan::findOrFail($id_periode_laporan);
    //     $idBulans = $periode->bulans->pluck('id_bulan')->toArray();

    //     $neraca1 = NeracaLimbah1::whereIn('id_bulan', $idBulans)->get();
    //     $neraca2 = NeracaLimbah2::whereIn('id_bulan', $idBulans)->first();
    //     $namaBulans = BulanModel::whereIn('id_bulan', $idBulans)->pluck('nama_bulan');
    //     $periode = $periode;

    //     $pdf = PDF::loadView('export.neraca', compact('neraca1', 'neraca2', 'namaBulans', 'periode'));

    //     return $pdf->stream('neraca.pdf');
    // }
    public function exportNeracaPDF($id_periode_laporan)
    {
        // Ambil data periode
        $periode = PeriodeLaporan::findOrFail($id_periode_laporan);

        // Ambil data id_bulan yang terkait dengan periode
        $idBulans = $periode->bulans->pluck('id_bulan')->toArray();

        // Buat instance dari NeracaPDFExport dan kirimkan variabel $idBulans ke constructor
        $export = new NeracaPDFExport($idBulans, $periode);

        // Ekspor dengan nama file tertentu jika diperlukan
        return Excel::download($export, 'neraca.pdf');
    }
}
