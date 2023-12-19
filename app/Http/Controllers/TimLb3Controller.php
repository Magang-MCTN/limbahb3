<?php

namespace App\Http\Controllers;

use App\Imports\LimbahMasukImport;
use App\Models\JenisLimbah;
use App\Models\LimbahMasuk;
use App\Models\PeriodeLaporan;
use App\Models\status;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TimLb3Controller extends Controller
{
    public function index()
    {
        // Jumlah periode
        // Hitung jumlah periode berdasarkan id_status_masuk
        $jumlahSemuaLaporan = PeriodeLaporan::whereNotNull('id_status_masuk')->count();
        $jumlahDraft = PeriodeLaporan::where('id_status_masuk', 1)->count();
        $jumlahMenunggu = PeriodeLaporan::where('id_status_masuk', 2)->count();
        $jumlahDitolak = PeriodeLaporan::where('id_status_masuk', 4)->count();
        $jumlahSelesai = PeriodeLaporan::whereIn('id_status_masuk', [6])->count(); // Misalnya, Anda ingin menghitung 6 dan 7 sebagai selesai

        $statuses = PeriodeLaporan::has('status')->with('status')->get();

        return view('dashboard.timlb3.index', compact('statuses', 'jumlahSemuaLaporan', 'jumlahDraft', 'jumlahMenunggu', 'jumlahDitolak', 'jumlahSelesai'));
    }
    public function showFormLimbahMasuk()
    {
        return view('dashboard.timlb3.formperiode');
    }

    public function submitFormKuartalTahun(Request $request)
    {
        $request->validate([
            'kuartal' => 'required',
            'tahun' => 'required|numeric|min:4',
        ]);

        // Cek apakah periode dengan kuartal dan tahun yang sama sudah ada
        $periode = PeriodeLaporan::where('kuartal', $request->input('kuartal'))
            ->where('tahun', $request->input('tahun'))
            ->first();

        // Jika periode sudah ada, gunakan periode tersebut
        if ($periode) {
            $idPeriode = $periode->id_periode_laporan;
        } else {
            // Jika periode belum ada, buat periode baru
            // $kuartalKeterangan = [
            //     '1' => 'Januari - Maret',
            //     '2' => 'April - Juni',
            //     '3' => 'Juli - September',
            //     '4' => 'Oktober - Desember',
            // ];

            // Tentukan keterangan kuartal berdasarkan nilai kuartal
            if ($request->input('kuartal') == 1) {
                $keteranganKuartal = 'Januari - Maret';
            } elseif ($request->input('kuartal') == 2) {
                $keteranganKuartal = 'April - Juni';
            } elseif ($request->input('kuartal') == 3) {
                $keteranganKuartal = 'Juli - September';
            } elseif ($request->input('kuartal') == 4) {
                $keteranganKuartal = 'Oktober - Desember';
            } else {
                // Penanganan jika nilai kuartal tidak sesuai dengan yang diharapkan
                return redirect()->back()->withInput()->withErrors(['Kuartal tidak valid']);
            }

            // Buat periode baru dan simpan ke dalam variabel $periode
            $periode = new PeriodeLaporan([
                'kuartal' => $request->input('kuartal'),
                'tahun' => $request->input('tahun'),
                'keterangan_kuartal' => $keteranganKuartal,
            ]);

            // Simpan periode ke dalam database
            $periode->save();

            $idPeriode = $periode->id_periode_laporan;
        }
        return redirect()->route('timlb3.showFormLimbahMasuk', ['id_periode_laporan' => $idPeriode])->with('success', 'Data periode berhasil disubmit.');
    }
    public function showFormLimbahMasuk2($id_periode_laporan = null)
    {
        $periodeLaporan = PeriodeLaporan::find($id_periode_laporan);
        $jenisLimbah = JenisLimbah::all();

        return view('dashboard.timlb3.forminputlimbahmasuk', compact('periodeLaporan', 'jenisLimbah'));
    }
    public function submitFormLimbahMasuk(Request $request)
    {
        try {



            // Ambil data limbah masuk dari tabel sementara
            $dataLimbahMasuk = $request->input('dataLimbahMasuk');

            // Validasi data limbah masuk dari tabel sementara
            foreach ($dataLimbahMasuk as $data) {
                $this->validate($request, [
                    'dataLimbahMasuk.*.id_jenis_limbah' => 'required|exists:jenis_limbahs,id_jenis_limbah',
                    'dataLimbahMasuk.*.satuan_limbah' => 'required|string',
                    'dataLimbahMasuk.*.tanggal_masuk' => 'required|date',
                    'dataLimbahMasuk.*.maksimal_penyimpanan' => 'required|numeric',
                    'dataLimbahMasuk.*.sumber_limbahB3' => 'required|string',
                    'dataLimbahMasuk.*.bentuk_limbahB3' => 'required|in:liquid,solid',
                    'dataLimbahMasuk.*.jumlah_limbah' => 'required|numeric',
                    'dataLimbahMasuk.*.berat_satuan' => 'required|numeric',
                    'dataLimbahMasuk.*.id_periode_laporan' => 'required|numeric',
                ]);
            }

            // Simpan data limbah masuk dari tabel sementara ke database
            foreach ($dataLimbahMasuk as $data) {
                $berat = $data['jumlah_limbah'] * $data['berat_satuan'];

                LimbahMasuk::create([
                    'id_jenis_limbah' => $data['id_jenis_limbah'],
                    'satuan_limbah' => $data['satuan_limbah'],
                    'tanggal_masuk' => $data['tanggal_masuk'],
                    'maksimal_penyimpanan' => $data['maksimal_penyimpanan'],
                    'sumber_limbahB3' => $data['sumber_limbahB3'],
                    'bentuk_limbahB3' => $data['bentuk_limbahB3'],
                    'jumlah_limbah' => $data['jumlah_limbah'],
                    'berat_satuan' => $data['berat_satuan'],
                    'berat' => $berat,
                    'id_status' => 1,
                    'id_periode_laporan' => $data['id_periode_laporan'],
                    'id_user' => auth()->user()->id,
                ]);


                $periode = PeriodeLaporan::find($data['id_periode_laporan']);
                $kuartal = $periode->kuartal;
                $tahun = $periode->tahun;

                $nomorDokumenMasuk = "MCTN/LB3/MSK{$kuartal}/{$tahun}";

                $periode->update([
                    'no_dokumen_masuk' => $nomorDokumenMasuk,
                    'id_status_masuk' => 1,
                ]);
            }
            // Bersihkan data di tabel sementara setelah berhasil disimpan
            // Alternatif: Anda dapat memilih untuk tidak membersihkan datanya jika perlu
            // unset($request['dataLimbahMasuk']);

            return response()->json(['success' => true, 'message' => 'Data limbah masuk berhasil disubmit.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    // public function status()
    // {
    //     $statuses = PeriodeLaporan::has('status')->with('status')->paginate(5);
    //     return view('dashboard.timlb3.status', compact('statuses'));
    // }
    public function status(Request $request)
    {
        // Ambil nilai pencarian dari input form
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

        return view('dashboard.timlb3.status', compact('statuses', 'tahun', 'daftarStatus', 'statusSurat'));
    }
    public function showDetailPeriode($id)
    {
        $periode = PeriodeLaporan::findOrFail($id);

        return view('dashboard.timlb3.detail_periode', compact('periode'));
    }
    public function lihatstatus($id)
    {
        $periode = PeriodeLaporan::with('status', 'limbahMasuk')->findOrFail($id);
        return view('status.show', compact('periode'));
    }
    public function limbah($id_periode_laporan)
    {
        $periode = PeriodeLaporan::findOrFail($id_periode_laporan);
        $limbahMasuk = $periode->limbahMasuk; // Adjust this based on your actual relationship

        return view('dashboard.timlb3.limbah_masuk', compact('periode', 'limbahMasuk'));
    }
    public function edit($id)
    {
        // Temukan data limbah masuk berdasarkan ID
        $limbahMasuk = LimbahMasuk::findOrFail($id);

        // Ambil semua jenis limbah untuk dropdown
        $jenisLimbahs = JenisLimbah::all();

        // Kirim data ke view edit
        return view('dashboard.timlb3.edit_limbah_masuk', compact('limbahMasuk', 'jenisLimbahs'));
    }


    public function update(Request $request, $id)
    {
        try {
            // Validasi form input
            $request->validate([
                'id_jenis_limbah' => 'required|exists:jenis_limbahs,id_jenis_limbah',
                'satuan_limbah' => 'required|string',
                'tanggal_masuk' => 'required|date',
                'maksimal_penyimpanan' => 'required|numeric',
                'sumber_limbahB3' => 'required|string',
                'bentuk_limbahB3' => 'required|in:liquid,solid',
                'jumlah_limbah' => 'required|numeric',
                'berat_satuan' => 'required|numeric',
                // Tambahkan validasi untuk atribut lainnya sesuai kebutuhan
            ]);

            // Temukan data limbah masuk berdasarkan ID
            $limbahMasuk = LimbahMasuk::findOrFail($id);

            // Update data limbah masuk
            $limbahMasuk->update([
                'id_jenis_limbah' => $request->input('id_jenis_limbah'),
                'satuan_limbah' => $request->input('satuan_limbah'),
                'tanggal_masuk' => $request->input('tanggal_masuk'),
                'maksimal_penyimpanan' => $request->input('maksimal_penyimpanan'),
                'sumber_limbahB3' => $request->input('sumber_limbahB3'),
                'bentuk_limbahB3' => $request->input('bentuk_limbahB3'),
                'jumlah_limbah' => $request->input('jumlah_limbah'),
                'berat_satuan' => $request->input('berat_satuan'),
                // Update atribut lainnya sesuai kebutuhan
            ]);

            return redirect()->route('limbah.masuk', $limbahMasuk->id_periode_laporan)->with('success', 'Data limbah masuk berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $limbahMasuk = LimbahMasuk::findOrFail($id);
        $limbahMasuk->delete();

        return redirect()->back()->with('success', 'Data limbah masuk berhasil dihapus.');
    }
    public function kirimPeriode($id)
    {
        $periode = PeriodeLaporan::findOrFail($id);
        // Tambahkan logika lain yang diperlukan
        $periode->update([
            'id_status_masuk' => 5,
            'tanggal_masuk' => now(), // Menggunakan fungsi now() untuk mendapatkan tanggal dan waktu saat ini
        ]);

        return redirect('/status');
    }
    public function showImportForm($id_periode)
    {
        return view('dashboard.timlb3.import', ['id_periode' => $id_periode]);
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
            'id_periode_laporan' => 'required|numeric',
        ]);

        $file = $request->file('file');
        $id_periode_laporan = $request->input('id_periode_laporan');

        try {
            Excel::import(new LimbahMasukImport($id_periode_laporan), $file);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan pada file Excel: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Data limbah masuk berhasil diimpor.');
    }
    public function createjenis()
    {
        return view('dashboard.timlb3.create');
    }
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'jenis_limbah' => 'required|string|max:255',
        ]);

        // Simpan jenis limbah
        JenisLimbah::create([
            'jenis_limbah' => $request->jenis_limbah,
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Jenis limbah berhasil disimpan!');
    }
}
