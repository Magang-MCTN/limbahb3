<?php

namespace App\Http\Controllers;

use App\Exports\LimbahKeluarExport;
use App\Models\PeriodeLaporan;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LimbahMasukExport;
use App\Models\TandaTangan;

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
}
