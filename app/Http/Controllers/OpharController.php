<?php

namespace App\Http\Controllers;

use App\Mail\Pengajuanreject;
use App\Mail\Pengajuanrejectk3;
use App\Mail\Pengajuanrejectneraca;
use App\Mail\Sendpengajuan;
use App\Mail\Sendpengajuanophar;
use App\Models\BulanModel;
use App\Models\LimbahKeluar;
use App\Models\LimbahMasuk;
use App\Models\NeracaLimbah1;
use App\Models\NeracaLimbah2;
use App\Models\PeriodeLaporan;
use App\Models\status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OpharController extends Controller
{
    public function index()
    {
        // Jumlah periode
        // Hitung jumlah periode berdasarkan id_status_masuk
        // Menghitung jumlah data periode dengan id_status_keluar dan id_status_neraca
        $jumlahLaporan = PeriodeLaporan::whereHas('statuskeluar')
            ->orWhereHas('statusneraca')
            ->count();

        // Menghitung jumlah data periode dengan id_status_keluar 1 (draft)
        $jumlahDraft = PeriodeLaporan::where(function ($query) {
            $query->whereHas('statuskeluar', function ($subquery) {
                $subquery->where('id_status_keluar', 1);
            })->orWhereHas('statusneraca', function ($subquery) {
                $subquery->where('id_status_neraca', 1);
            });
        })->count();

        // Menghitung jumlah data periode dengan id_status_keluar 2 (menunggu)
        $jumlahMenunggu = PeriodeLaporan::where(function ($query) {
            $query->whereHas('statuskeluar', function ($subquery) {
                $subquery->where('id_status_keluar', 2);
            })->orWhereHas('statusneraca', function ($subquery) {
                $subquery->where('id_status_neraca', 2);
            });
        })->count();

        // Menghitung jumlah data periode dengan id_status_keluar 4 (ditolak)
        $jumlahDitolak = PeriodeLaporan::where(function ($query) {
            $query->whereHas('statuskeluar', function ($subquery) {
                $subquery->where('id_status_keluar', 4);
            })->orWhereHas('statusneraca', function ($subquery) {
                $subquery->where('id_status_neraca', 4);
            });
        })->count();

        // Menghitung jumlah data periode dengan id_status_keluar 6 (selesai)
        $jumlahSelesai = PeriodeLaporan::where(function ($query) {
            $query->whereHas('statuskeluar', function ($subquery) {
                $subquery->whereIn('id_status_keluar', [6]);
            })->orWhereHas('statusneraca', function ($subquery) {
                $subquery->whereIn('id_status_neraca', [6]);
            });
        })->count();

        // Mengambil data statuses dan statusesneraca seperti yang telah Anda lakukan sebelumnya
        $statuses = PeriodeLaporan::has('statuskeluar')->with('statuskeluar')->get();
        $statusesneraca = PeriodeLaporan::has('statusneraca')->with('statusneraca')->get();
        $periodes = PeriodeLaporan::with('status')->get();

        return view('dashboard.ophar.index', compact('periodes', 'statusesneraca', 'statuses', 'jumlahLaporan', 'jumlahDraft', 'jumlahMenunggu', 'jumlahDitolak', 'jumlahSelesai'));
        // return view('dashboard.ophar.index', compact('statusesneraca', 'statuses', 'jumlahLaporan', 'jumlahDraft', 'jumlahMenunggu', 'jumlahDitolak', 'jumlahSelesai'));
    }

    public function status(Request $request)
    {
        $tahun = $request->input('tahun');
        $statusSurat = $request->input('status_surat');

        // Query data dengan kondisi pencarian
        $query = PeriodeLaporan::has('status')->with('status');

        if (!empty($tahun)) {
            $query->where('tahun', 'LIKE', "%$tahun%");
        }

        if (!empty($statusSurat)) {
            $query->whereHas('status', function ($q) use ($statusSurat) {
                $q->where('id_status', $statusSurat);
            });
        }

        $statuses = $query->paginate(5);

        // Ambil daftar status untuk dropdown filter
        $daftarStatus = status::all();

        return view('dashboard.ophar.status', compact('statuses', 'tahun', 'daftarStatus', 'statusSurat'));
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
            $user = User::where('id_role', 4)->first();
            $periode = PeriodeLaporan::findOrFail($id);
            $periode->update(['id_status_masuk' => 2]); // Ubah status masuk menjadi disetujui (ID status 2)
            // $periode->alasan = $request->input('alasan_limbah_masuk');
            $periode->save();
            Mail::to($user->email)->send(new Sendpengajuanophar($id));
            return redirect()->route('ophar.show', ['id' => $id])->with('success', 'Berhasil menyetujui dokumen Limbah Masuk.');
        } catch (\Exception $e) {
            return redirect()->route('ophar.show', ['id' => $id])->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function rejectLimbahMasuk($id)
    {
        try {
            $user = User::where('id_role', 1)->first();
            $periode = PeriodeLaporan::findOrFail($id);
            $periode->update(['id_status_masuk' => 4]); // Ubah status masuk menjadi ditolak (ID status 4)
            Mail::to($user->email)->send(new Pengajuanreject($id));
            return redirect()->route('ophar.show', ['id' => $id])->with('success', 'Berhasil menolak dokumen Limbah Masuk.');
        } catch (\Exception $e) {
            return redirect()->route('ophar.show', ['id' => $id])->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function approveLimbahKeluar($id)
    {
        try {
            $user = User::where('id_role', 4)->first();
            $periode = PeriodeLaporan::findOrFail($id);
            $periode->update(['id_status_keluar' => 2]); // Ubah status masuk menjadi disetujui (ID status 2)
            Mail::to($user->email)->send(new Sendpengajuanophar($id));
            return redirect()->route('ophar.show', ['id' => $id])->with('success', 'Berhasil menyetujui dokumen Limbah Keluar.');
        } catch (\Exception $e) {
            return redirect()->route('ophar.show', ['id' => $id])->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function rejectLimbahKeluar($id)
    {
        try {
            $user = User::where('id_role', 2)->first();
            $periode = PeriodeLaporan::findOrFail($id);
            $periode->update(['id_status_keluar' => 4]); // Ubah status masuk menjadi ditolak (ID status 4)
            Mail::to($user->email)->send(new Pengajuanrejectk3($id));
            return redirect()->route('ophar.show', ['id' => $id])->with('success', 'Berhasil menolak dokumen Limbah Keluar.');
        } catch (\Exception $e) {
            return redirect()->route('ophar.show', ['id' => $id])->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function approveLimbahNeraca($id)
    {
        try {
            $user = User::where('id_role', 4)->first();
            $periode = PeriodeLaporan::findOrFail($id);
            $periode->update(['id_status_neraca' => 2]); // Ubah status masuk menjadi disetujui (ID status 2)
            Mail::to($user->email)->send(new Sendpengajuanophar($id));
            return redirect()->route('ophar.show', ['id' => $id])->with('success', 'Berhasil menyetujui dokumen Limbah Neraca.');
        } catch (\Exception $e) {
            return redirect()->route('ophar.show', ['id' => $id])->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function rejectLimbahNeraca($id)
    {
        try {

            $user = User::where('id_role', 2)->first();
            $periode = PeriodeLaporan::findOrFail($id);
            $periode->update(['id_status_neraca' => 4]); // Ubah status masuk menjadi ditolak (ID status 4)
            Mail::to($user->email)->send(new Pengajuanrejectneraca($id));
            return redirect()->route('ophar.show', ['id' => $id])->with('success', 'Berhasil menolak dokumen Limbah Neraca.');
        } catch (\Exception $e) {
            return redirect()->route('ophar.show', ['id' => $id])->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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
