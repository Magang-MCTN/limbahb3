<?php

namespace App\Http\Controllers;

use App\Models\BulanModel;
use App\Models\LimbahKeluar;
use App\Models\LimbahMasuk;
use App\Models\NeracaLimbah1;
use App\Models\NeracaLimbah2;
use App\Models\PeriodeLaporan;
use Illuminate\Http\Request;

class OpharController extends Controller
{
    public function index()
    {
        return view('dashboard.ophar.index',);
    }
    public function persetujuan()
    {
        $periodes = PeriodeLaporan::with('status')->get();

        return view('dashboard.ophar.persetujuan', compact('periodes'));
    }
    public function show($id_periode_laporan)
    {
        $periode = PeriodeLaporan::with(['limbahMasuk', 'limbahKeluar', 'neracaLimbah1', 'neracaLimbah2'])->findOrFail($id_periode_laporan);

        return view('dashboard.ophar.detail_periode', compact('periode'));
    }

    public function approveLimbahMasuk(Request $request, $id)
    {
        try {
            $periode = PeriodeLaporan::findOrFail($id);
            $periode->update(['id_status_masuk' => 2]); // Ubah status masuk menjadi disetujui (ID status 2)
            $periode->alasan = $request->input('alasan_limbah_masuk');
            $periode->save();

            return redirect()->route('ophr.show', ['id' => $id])->with('success', 'Berhasil menyetujui dokumen Limbah Masuk.');
        } catch (\Exception $e) {
            return redirect()->route('ophr.show', ['id' => $id])->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function rejectLimbahMasuk($id)
    {
        try {
            $periode = PeriodeLaporan::findOrFail($id);
            $periode->update(['id_status_masuk' => 4]); // Ubah status masuk menjadi ditolak (ID status 4)

            return redirect()->route('ophr.show', ['id' => $id])->with('success', 'Berhasil menolak dokumen Limbah Masuk.');
        } catch (\Exception $e) {
            return redirect()->route('ophr.show', ['id' => $id])->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function approveLimbahKeluar($id)
    {
        try {
            $periode = PeriodeLaporan::findOrFail($id);
            $periode->update(['id_status_keluar' => 2]); // Ubah status masuk menjadi disetujui (ID status 2)

            return redirect()->route('ophr.show', ['id' => $id])->with('success', 'Berhasil menyetujui dokumen Limbah Keluar.');
        } catch (\Exception $e) {
            return redirect()->route('ophr.show', ['id' => $id])->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function rejectLimbahKeluar($id)
    {
        try {
            $periode = PeriodeLaporan::findOrFail($id);
            $periode->update(['id_status_keluar' => 4]); // Ubah status masuk menjadi ditolak (ID status 4)

            return redirect()->route('ophr.show', ['id' => $id])->with('success', 'Berhasil menolak dokumen Limbah Keluar.');
        } catch (\Exception $e) {
            return redirect()->route('ophr.show', ['id' => $id])->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function approveLimbahNeraca($id)
    {
        try {
            $periode = PeriodeLaporan::findOrFail($id);
            $periode->update(['id_status_neraca' => 2]); // Ubah status masuk menjadi disetujui (ID status 2)

            return redirect()->route('ophr.show', ['id' => $id])->with('success', 'Berhasil menyetujui dokumen Limbah Neraca.');
        } catch (\Exception $e) {
            return redirect()->route('ophr.show', ['id' => $id])->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function rejectLimbahNeraca($id)
    {
        try {
            $periode = PeriodeLaporan::findOrFail($id);
            $periode->update(['id_status_neraca' => 4]); // Ubah status masuk menjadi ditolak (ID status 4)

            return redirect()->route('ophr.show', ['id' => $id])->with('success', 'Berhasil menolak dokumen Limbah Neraca.');
        } catch (\Exception $e) {
            return redirect()->route('ophr.show', ['id' => $id])->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function limbah($id_periode_laporan)
    {
        $periode = PeriodeLaporan::findOrFail($id_periode_laporan);
        $limbahMasuk = $periode->limbahMasuk; // Adjust this based on your actual relationship

        return view('dashboard.ophar.limbah_masuk', compact('periode', 'limbahMasuk'));
    }
    public function limbahkeluar($id_periode_laporan)
    {
        $periode = PeriodeLaporan::findOrFail($id_periode_laporan);
        $limbahkeluar = $periode->limbahkeluar; // Adjust this based on your actual relationship

        return view('dashboard.ophar.limbah_keluar', compact('periode', 'limbahkeluar'));
    }
    public function detailBulan($id_periode_laporan)
    {
        // Ambil data periode
        $periode = PeriodeLaporan::findOrFail($id_periode_laporan);

        // Ambil data bulan-bulan yang terkait dengan periode
        $bulans = $periode->bulans;


        return view('dashboard.ophar.detail_bulan', compact('periode', 'bulans'));
    }
    public function lihatNeracaPerbulan($id_bulan)
    {
        // Ambil data bulan
        $bulan = BulanModel::findOrFail($id_bulan);

        // Ambil data neraca 1 dan 2 berdasarkan id bulan
        $neraca1 = NeracaLimbah1::where('id_bulan', $id_bulan)->get();
        $neraca2 = NeracaLimbah2::where('id_bulan', $id_bulan)->first();

        return view('dashboard.ophar.lihat_neraca_perbulan', compact('bulan', 'neraca1', 'neraca2'));
    }
}
