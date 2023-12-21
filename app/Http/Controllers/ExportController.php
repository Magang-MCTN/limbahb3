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
use App\Models\User;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\View;

class ExportController extends Controller
{
    public function exportLimbahMasuk($id_periode_laporan)
    {
        $periode = PeriodeLaporan::findOrFail($id_periode_laporan);
        $limbahMasuk = $periode->limbahMasuk;
        $periodes = $periode->tanggal_masuk;
        // Buat judul sesuai kebutuhan
        $judul = 'PT. MANDAU CIPTA TENAGA NUSANTARA - NORTH DURI COGEN (' . date('Y') . ')';

        // Inisialisasi kelas eksport dengan judul dan data Limbah Masuk
        $export = new LimbahMasukExport($judul, $limbahMasuk, $periodes);

        // Export dengan nama file tertentu (opsional)
        return Excel::download($export, 'limbah_masuk.xlsx');
    }
    public function exportLimbahKeluar($id_periode_laporan)
    {
        $periode = PeriodeLaporan::findOrFail($id_periode_laporan);
        $limbahKeluar = $periode->limbahKeluar;
        $periodes = $periode->tanggal_keluar;

        $tandaTangan = $this->getTandaTanganForRoleFour();
        $judul = 'PT. MANDAU CIPTA TENAGA NUSANTARA - NORTH DURI COGEN (' . date('Y') . ')';

        // Sesuaikan nama variabel menjadi $tandaTangan
        $export = new LimbahKeluarExport($judul, $limbahKeluar, $tandaTangan, $periodes);

        return Excel::download($export, 'limbah_keluar.xlsx');
    }

    private function getTandaTanganForRoleFour()
    {
        $user = User::where('id_role', 4)->first();
        return $user ? $user->tandaTangan : null;
    }




    // public function exportLimbahKeluar($id_periode_laporan)
    // {
    //     $periode = PeriodeLaporan::findOrFail($id_periode_laporan);
    //     $limbahKeluar = $periode->limbahKeluar;
    //     $tandaTangan = TandaTangan::first();

    //     $judul = 'PT. MANDAU CIPTA TENAGA NUSANTARA - NORTH DURI COGEN (' . date('Y') . ')';
    //     $export = new LimbahKeluarExport($judul, $limbahKeluar, $tandaTangan);

    //     return Excel::download($export, 'limbah_keluar.xlsx');
    // }
    // public function exportNeraca($id_periode_laporan)
    // {
    //     return Excel::download(new NeracaExport($id_periode_laporan), 'neraca.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    // }
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
    // public function exportNeracaPDF($id_periode_laporan)
    // {
    //     // Ambil data periode
    //     $periode = PeriodeLaporan::findOrFail($id_periode_laporan);

    //     // Ambil data id_bulan yang terkait dengan periode
    //     $idBulans = $periode->bulans->pluck('id_bulan')->toArray();

    //     // Buat instance dari NeracaPDFExport dan kirimkan variabel $idBulans ke constructor
    //     $export = new NeracaPDFExport($idBulans, $periode);

    //     // Ekspor dengan nama file tertentu jika diperlukan
    //     return Excel::download($export, 'neraca.pdf');
    // }
    public function exportNeracaPDFnottd($id_periode_laporan)
    {
        $periode = PeriodeLaporan::findOrFail($id_periode_laporan);
        $idBulans = $periode->bulans->pluck('id_bulan')->toArray();
        $tandaTangan = TandaTangan::whereHas('user', function ($query) {
            $query->where('id_role', 4);
        })->first();
        $ttd = $tandaTangan->path;
        $formattedDate = Carbon::parse($periode->tanggal_neraca)->formatLocalized('%d %B %Y');
        $bulanData = [];
        foreach ($idBulans as $idBulan) {
            $neraca1 = NeracaLimbah1::where('id_bulan', $idBulan)

                ->get();

            $neraca2 = NeracaLimbah2::where('id_bulan', $idBulan)

                ->first();

            $namaBulan = BulanModel::find($idBulan)->nama_bulan;
            $bulanData[] = compact('ttd', 'neraca1', 'neraca2', 'namaBulan', 'periode', 'formattedDate');
        }

        $pdf = PDF::loadView('export.neraca_multi_bulannottd', compact('ttd', 'bulanData', 'neraca1', 'neraca2', 'namaBulan', 'periode', 'formattedDate'));

        return $pdf->stream('neraca.pdf');
    }
    public function exportNeracaPDF($id_periode_laporan)
    {
        $periode = PeriodeLaporan::findOrFail($id_periode_laporan);
        $idBulans = $periode->bulans->pluck('id_bulan')->toArray();
        $tandaTangan = TandaTangan::whereHas('user', function ($query) {
            $query->where('id_role', 4);
        })->first();
        $ttd = $tandaTangan->path;
        $formattedDate = Carbon::parse($periode->tanggal_neraca)->formatLocalized('%d %B %Y');
        $bulanData = [];
        foreach ($idBulans as $idBulan) {
            $neraca1 = NeracaLimbah1::where('id_bulan', $idBulan)

                ->get();

            $neraca2 = NeracaLimbah2::where('id_bulan', $idBulan)

                ->first();

            $namaBulan = BulanModel::find($idBulan)->nama_bulan;
            $bulanData[] = compact('ttd', 'neraca1', 'neraca2', 'namaBulan', 'periode', 'formattedDate');
        }

        $pdf = PDF::loadView('export.neraca_multi_bulan', compact('ttd', 'bulanData', 'neraca1', 'neraca2', 'namaBulan', 'periode', 'formattedDate'));

        return $pdf->stream('neraca.pdf');
    }
}
