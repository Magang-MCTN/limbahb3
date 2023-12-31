<?php

namespace App\Http\Controllers;

use App\Models\BulanModel;
use App\Models\DataPengelolaanLb3;
use App\Models\NeracaLimbah1;
use App\Models\NeracaLimbah2;
use App\Models\PeriodeLaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminlobiController extends Controller
{
    public function index()
    {
        return view('dashboard.adminlobi.index',);
    }
    public function persetujuan()
    {
        $periodes = PeriodeLaporan::with('status')->get();

        return view('dashboard.adminlobi.persetujuan', compact('periodes'));
    }
    public function show($id_periode_laporan)
    {
        $periode = PeriodeLaporan::with(['limbahMasuk', 'limbahKeluar', 'neracaLimbah1', 'neracaLimbah2'])->findOrFail($id_periode_laporan);

        // Ambil data dokumen tambahan jika sudah ada
        $dokumenTambahan = DataPengelolaanLb3::where('id_periode', $id_periode_laporan)->first();

        return view('dashboard.adminlobi.detail_periode', compact('periode', 'dokumenTambahan'));
    }

    public function approveLimbahMasuk(Request $request, $id)
    {
        try {
            $periode = PeriodeLaporan::findOrFail($id);
            $periode->update(['id_status_masuk' => 3]); // Ubah status masuk menjadi disetujui (ID status 2)
            $periode->alasan = $request->input('alasan_limbah_masuk');
            $periode->save();

            return redirect()->route('adminlobi.show', ['id' => $id])->with('success', 'Berhasil menyetujui dokumen Limbah Masuk.');
        } catch (\Exception $e) {
            return redirect()->route('adminlobi.show', ['id' => $id])->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function rejectLimbahMasuk($id)
    {
        try {
            $periode = PeriodeLaporan::findOrFail($id);
            $periode->update(['id_status_masuk' => 4]); // Ubah status masuk menjadi ditolak (ID status 4)

            return redirect()->route('adminlobi.show', ['id' => $id])->with('success', 'Berhasil menolak dokumen Limbah Masuk.');
        } catch (\Exception $e) {
            return redirect()->route('adminlobi.show', ['id' => $id])->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function approveLimbahKeluar($id)
    {
        try {
            $periode = PeriodeLaporan::findOrFail($id);
            $periode->update(['id_status_keluar' => 3]); // Ubah status masuk menjadi disetujui (ID status 2)

            return redirect()->route('adminlobi.show', ['id' => $id])->with('success', 'Berhasil menyetujui dokumen Limbah Keluar.');
        } catch (\Exception $e) {
            return redirect()->route('adminlobi.show', ['id' => $id])->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function rejectLimbahKeluar($id)
    {
        try {
            $periode = PeriodeLaporan::findOrFail($id);
            $periode->update(['id_status_keluar' => 4]); // Ubah status masuk menjadi ditolak (ID status 4)

            return redirect()->route('adminlobi.show', ['id' => $id])->with('success', 'Berhasil menolak dokumen Limbah Keluar.');
        } catch (\Exception $e) {
            return redirect()->route('adminlobi.show', ['id' => $id])->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function approveLimbahNeraca($id)
    {
        try {
            $periode = PeriodeLaporan::findOrFail($id);
            $periode->update(['id_status_neraca' => 3]); // Ubah status masuk menjadi disetujui (ID status 2)

            return redirect()->route('adminlobi.show', ['id' => $id])->with('success', 'Berhasil menyetujui dokumen Limbah Neraca.');
        } catch (\Exception $e) {
            return redirect()->route('adminlobi.show', ['id' => $id])->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function rejectLimbahNeraca($id)
    {
        try {
            $periode = PeriodeLaporan::findOrFail($id);
            $periode->update(['id_status_neraca' => 4]); // Ubah status masuk menjadi ditolak (ID status 4)

            return redirect()->route('adminlobi.show', ['id' => $id])->with('success', 'Berhasil menolak dokumen Limbah Neraca.');
        } catch (\Exception $e) {
            return redirect()->route('adminlobi.show', ['id' => $id])->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function limbah($id_periode_laporan)
    {
        $periode = PeriodeLaporan::findOrFail($id_periode_laporan);
        $limbahMasuk = $periode->limbahMasuk; // Adjust this based on your actual relationship

        return view('dashboard.adminlobi.limbah_masuk', compact('periode', 'limbahMasuk'));
    }
    public function limbahkeluar($id_periode_laporan)
    {
        $periode = PeriodeLaporan::findOrFail($id_periode_laporan);
        $limbahkeluar = $periode->limbahkeluar; // Adjust this based on your actual relationship

        return view('dashboard.adminlobi.limbah_keluar', compact('periode', 'limbahkeluar'));
    }
    public function detailBulan($id_periode_laporan)
    {
        // Ambil data periode
        $periode = PeriodeLaporan::findOrFail($id_periode_laporan);

        // Ambil data bulan-bulan yang terkait dengan periode
        $bulans = $periode->bulans;


        return view('dashboard.adminlobi.detail_bulan', compact('periode', 'bulans'));
    }
    public function lihatNeracaPerbulan($id_bulan)
    {
        // Ambil data bulan
        $bulan = BulanModel::findOrFail($id_bulan);

        // Ambil data neraca 1 dan 2 berdasarkan id bulan
        $neraca1 = NeracaLimbah1::where('id_bulan', $id_bulan)->get();
        $neraca2 = NeracaLimbah2::where('id_bulan', $id_bulan)->first();

        return view('dashboard.adminlobi.lihat_neraca_perbulan', compact('bulan', 'neraca1', 'neraca2'));
    }
    public function historilimbah()
    {
        $periodes = PeriodeLaporan::with('status')->get();

        return view('dashboard.adminlobi.histori', compact('periodes'));
    }
    public function storeDokumenTambahan(Request $request, $id_periode_laporan)
    {
        // Validasi request
        $request->validate([
            'file_klhk' => 'required|mimes:pdf|max:2048',
            'file_pemda_riau' => 'required|mimes:pdf|max:2048',
            'file_pemda_bengkalis' => 'required|mimes:pdf|max:2048',
        ]);

        // Simpan dokumen tambahan
        $dokumen = new DataPengelolaanLb3();

        $dokumen->id_periode = $id_periode_laporan;
        $dokumen->file_klhk = $request->file_klhk->store('public/dokumen_tambahan');
        $dokumen->file_pemda_riau = $request->file_pemda_riau->store('public/dokumen_tambahan');
        $dokumen->id_user = Auth::id();
        $dokumen->file_pemda_bengkalis = $request->file_pemda_bengkalis->store('public/dokumen_tambahan');
        $dokumen->save();

        // Update status periode menjadi selesai (id_status 6)
        $periode = PeriodeLaporan::findOrFail($id_periode_laporan);
        $periode->id_status_masuk = 6;
        $periode->id_status_keluar = 6;
        $periode->id_status_neraca = 6;
        $periode->save();

        return redirect()->back()->with('success', 'Dokumen tambahan berhasil disimpan.');
    }
}
