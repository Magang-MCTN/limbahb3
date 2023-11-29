<?php

namespace App\Http\Controllers;

use App\Models\BulanModel;
use App\Models\JenisLimbah;
use App\Models\LimbahKeluar;
use App\Models\LimbahMasuk;
use App\Models\NeracaLimbah1;
use App\Models\NeracaLimbah2;
use App\Models\PeriodeLaporan;
use Illuminate\Http\Request;

class TimK3Controller extends Controller
{
    public function index()
    {
        return view('dashboard.timk3.index',);
    }
    public function showFormLimbahKeluar()
    {
        return view('dashboard.timk3.formperiode');
    }

    public function submitFormKuartalTahun(Request $request)
    {
        $request->validate([
            'kuartal' => 'required|string|in:1,2,3,4',
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

            $idPeriode = $periode->id_periode_laporan;
        }

        return redirect()->route('timk3.showFormLimbahKeluar2', ['id_periode_laporan' => $idPeriode])->with('success', 'Data periode berhasil disubmit.');
    }
    public function showFormLimbahkeluar2($id_periode_laporan = null)
    {
        $periodeLaporan = PeriodeLaporan::find($id_periode_laporan);
        $jenisLimbah = JenisLimbah::all();

        return view('dashboard.timk3.forminputlimbahkeluar', compact('periodeLaporan', 'jenisLimbah'));
    }
    public function submitFormLimbahkeluar(Request $request)
    {
        try {



            // Ambil data limbah masuk dari tabel sementara
            $dataLimbahkeluar = $request->input('dataLimbahkeluar');

            // Validasi data limbah keluar dari tabel sementara
            foreach ($dataLimbahkeluar as $data) {
                $this->validate($request, [
                    'dataLimbahkeluar.*.id_jenis_limbah' => 'required|exists:jenis_limbahs,id_jenis_limbah',
                    'dataLimbahkeluar.*.tujuanPenyerahan' => 'required|string',
                    'dataLimbahkeluar.*.tanggal_keluar' => 'required|date',
                    'dataLimbahkeluar.*.jumlahkg' => 'required|numeric',
                    'dataLimbahkeluar.*.sisa_lb3' => 'required|numeric',
                    'dataLimbahkeluar.*.buktiNomorDokumen' => 'required|string',
                    'dataLimbahkeluar.*.id_periode_laporan' => 'required|numeric',
                ]);
            }

            // Simpan data limbah keluar dari tabel sementara ke database
            foreach ($dataLimbahkeluar as $data) {
                $berat = $data['jumlahkg'] / 1000;

                LimbahKeluar::create([
                    'id_jenis_limbah' => $data['id_jenis_limbah'],
                    'tujuanPenyerahan' => $data['tujuanPenyerahan'],
                    'tanggal_keluar' => $data['tanggal_keluar'],
                    'jumlahkg' => $data['jumlahkg'],
                    'sisa_lb3' => $data['sisa_lb3'],
                    'buktiNomorDokumen' => $data['buktiNomorDokumen'],
                    'jumlahton' => $berat,
                    'id_status' => 1,
                    'id_periode_laporan' => $data['id_periode_laporan'],
                    'id_user' => auth()->user()->id,
                ]);


                $periode = PeriodeLaporan::find($data['id_periode_laporan']);
                $kuartal = $periode->kuartal;
                $tahun = $periode->tahun;

                $nomorDokumenkeluar = "MCTN/LB3/KLR{$kuartal}/{$tahun}";

                $periode->update([
                    'no_dokumen_keluar' => $nomorDokumenkeluar,
                    'id_status_keluar' => 1,
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
    public function statuskeluar()
    {
        // Hanya ambil data periode yang memiliki id_status_keluar
        $statuses = PeriodeLaporan::has('statuskeluar')->with('statuskeluar')->get();

        return view('dashboard.timk3.status', compact('statuses'));
    }
    public function showDetailPeriode($id)
    {
        $periode = PeriodeLaporan::findOrFail($id);

        return view('dashboard.timk3.detail_periode', compact('periode'));
    }
    public function lihatstatus($id)
    {
        $periode = PeriodeLaporan::with('status', 'limbahMasuk')->findOrFail($id);
        return view('status.show', compact('periode'));
    }
    public function limbahkeluar($id_periode_laporan)
    {
        $periode = PeriodeLaporan::findOrFail($id_periode_laporan);
        $limbahkeluar = $periode->limbahkeluar; // Adjust this based on your actual relationship

        return view('dashboard.timk3.limbah_keluar', compact('periode', 'limbahkeluar'));
    }
    public function editlimbah($id)
    {
        // Temukan data limbah masuk berdasarkan ID
        $limbahkeluar = LimbahKeluar::findOrFail($id);

        // Ambil semua jenis limbah untuk dropdown
        $jenisLimbahs = JenisLimbah::all();

        // Kirim data ke view edit
        return view('dashboard.timk3.edit_limbah_keluar', compact('limbahkeluar', 'jenisLimbahs'));
    }


    public function updatelimbah(Request $request, $id)
    {
        try {
            // Validasi form input
            $request->validate([
                'id_jenis_limbah' => 'required|exists:jenis_limbahs,id_jenis_limbah',
                'tujuanPenyerahan' => 'required|string',
                'tanggal_keluar' => 'required|date',
                'jumlahkg' => 'required|numeric',
                'sisa_lb3' => 'required|string',
                'buktiNomorDokumen' => 'required|string',
                // 'jumlah_limbah' => 'required|numeric',
                // 'berat_satuan' => 'required|numeric',
                // Tambahkan validasi untuk atribut lainnya sesuai kebutuhan
            ]);

            // Temukan data limbah masuk berdasarkan ID
            $limbahkeluar = LimbahKeluar::findOrFail($id);
            $berat = $request['jumlahkg'] / 1000;
            // Update data limbah masuk
            $limbahkeluar->update([
                'id_jenis_limbah' => $request->input('id_jenis_limbah'),
                'tujuanPenyerahan' => $request->input('tujuanPenyerahan'),
                'tanggal_keluar' => $request->input('tanggal_keluar'),
                'jumlahkg' => $request->input('jumlahkg'),
                'sisa_lb3' => $request->input('sisa_lb3'),
                'buktiNomorDokumen' => $request->input('buktiNomorDokumen'),
                'jumlahton' => $berat,
                // 'jumlah_limbah' => $request->input('jumlah_limbah'),
                // 'berat_satuan' => $request->input('berat_satuan'),
                // Update atribut lainnya sesuai kebutuhan
            ]);

            return redirect()->route('limbah.keluar', $limbahkeluar->id_periode_laporan)->with('success', 'Data limbah masuk berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $limbahkeluar = LimbahKeluar::findOrFail($id);
        $limbahkeluar->delete();

        return redirect()->back()->with('success', 'Data limbah masuk berhasil dihapus.');
    }
    public function kirimPeriode($id)
    {
        $periode = PeriodeLaporan::findOrFail($id);
        // Tambahkan logika lain yang diperlukan
        $periode->update(['id_status_keluar' => 5]);

        return redirect('/timk3/status');
    }
    public function showFormNeraca()
    {
        // Ambil daftar periode untuk dropdown
        $periodes = PeriodeLaporan::all();

        return view('dashboard.timk3.formneraca', compact('periodes'));
    }

    public function submitFormNeraca(Request $request)
    {
        $request->validate([
            'nama_bulan' => 'required',
            'kuartal' => 'required|numeric|in:1,2,3,4',
            'tahun' => 'required|numeric|min:4',
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);

        // Cek apakah sudah ada data periode dengan kuartal dan tahun yang sama
        $periode = PeriodeLaporan::where('kuartal', $request->kuartal)
            ->where('tahun', $request->tahun)
            ->first();

        // Jika belum ada, buat data periode baru
        if (!$periode) {
            $periode = new PeriodeLaporan();
            $periode->kuartal = $request->kuartal;
            $periode->tahun = $request->tahun;
            $periode->save();
        }

        // Buat data bulan
        $bulan = new BulanModel();
        $bulan->nama_bulan = $request->nama_bulan;
        $bulan->id_periode_laporan = $periode->id_periode_laporan;
        $bulan->save();

        // Tambahkan logika untuk menyimpan data neraca sesuai kebutuhan

        return redirect()->route('timk3.showFormNeraca1', ['id_bulan' => $bulan->id_bulan])->with('success', 'Data bulan berhasil disubmit.');
    }
    public function showFormNeraca1($id_bulan)
    {
        $bulan = BulanModel::findOrFail($id_bulan);
        $jenisLimbah = JenisLimbah::all();

        return view('dashboard.timk3.form_neraca1', compact('bulan', 'jenisLimbah'));
    }
    public function submitFormNeraca1(Request $request, $id_bulan)
    {
        try {
            $bulan = BulanModel::findOrFail($id_bulan);
            $periode = $bulan->periode; // Sesuaikan dengan relasi yang ada di model BulanModel

            $dataNeraca1 = $request->input('dataNeraca1');
            foreach ($dataNeraca1 as $data) {
                $this->validate($request, [
                    '$dataNeraca1.*.id_jenis_limbah' => 'required|exists:jenis_limbahs,id_jenis_limbah',
                    '$dataNeraca1.*.sumber_limbah' => 'required|string',
                    '$dataNeraca1.*.dihasilkan' => 'required|numeric',
                    '$dataNeraca1.*.disimpan' => 'required|numeric',
                    '$dataNeraca1.*.diolah' => 'required|numeric',
                    '$dataNeraca1.*.ditimbun' => 'required|numeric',
                    '$dataNeraca1.*.diserahkan' => 'required|numeric',
                    '$dataNeraca1.*.eksport' => 'required|numeric',
                    '$dataNeraca1.*.lainnya' => 'required|numeric',
                ]);
            }
            foreach ($dataNeraca1 as $data) {
                // Sesuaikan dengan nama-nama kolom yang ada di tabel NeracaLimbah1
                NeracaLimbah1::create([
                    'id_jenis_limbah' => $data['id_jenis_limbah'],
                    'sumber_limbah' => $data['sumber'],
                    'dihasilkan' => $data['dihasilkan'],
                    'disimpan' => $data['disimpan'],
                    'dimanfaatkan' => $data['dimanfaatkan'],
                    'diolah' => $data['diolah'],
                    'ditimbun' => $data['ditimbun'],
                    'diserahkan' => $data['diserahkan'],
                    'eksport' => $data['eksport'],
                    'lainnya' => $data['lainnya'],
                    'id_bulan' => $id_bulan,
                    'id_user' => auth()->user()->id, // Sesuaikan dengan kolom yang menunjukkan hubungan antara NeracaLimbah1 dan BulanModel
                    // Tambahkan kolom lainnya sesuai kebutuhan
                ]);
            }


            return redirect()->route('timk3.showFormNeraca2', $id_bulan)->with('success', 'Data Neraca 1 berhasil disubmit.');
        } catch (\Exception $e) {
            return redirect()->route('timk3.showFormNeraca2', $id_bulan)->with('success', 'Data Neraca 1 berhasil disubmit.');
        }
    }
    public function showFormNeraca2($id_bulan)
    {
        // Ambil data bulan
        $bulan = BulanModel::findOrFail($id_bulan);

        return view('dashboard.timk3.form_neraca2', compact('bulan'));
    }

    public function submitFormNeraca2(Request $request, $id_bulan)
    {
        try {
            // Validasi request
            $request->validate([
                'total_neraca' => 'required|numeric',
                'residu' => 'required|numeric',
                'limbah_belum_dikelola' => 'required|numeric',
                'limbah_tersisa' => 'required|numeric',
                'kinerja_pengelolaan' => 'required|numeric',
                'dokumen_kontrol' => 'required|string',
                'perizinan_limbah_klh' => 'required|string',
                'no_izin_limbah_klh' => 'required|string',
                'catatan' => 'nullable|string',
            ]);

            // Simpan data Neraca Limbah 2 ke database
            NeracaLimbah2::create([
                'total_neraca' => $request->total_neraca,
                'residu' => $request->residu,
                'limbah_belum_dikelola' => $request->limbah_belum_dikelola,
                'limbah_tersisa' => $request->limbah_tersisa,
                'kinerja_pengelolaan' => $request->kinerja_pengelolaan,
                'dokumen_kontrol' => $request->dokumen_kontrol,
                'perizinan_limbah_klh' => $request->perizinan_limbah_klh,
                'no_izin_limbah_klh' => $request->no_izin_limbah_klh,
                'catatan' => $request->catatan,
                'id_bulan' => $id_bulan,
                'id_user' => auth()->user()->id,
            ]);
            $bulan = BulanModel::findOrFail($id_bulan);

            // Ambil atau buat data periode
            $periode = PeriodeLaporan::firstOrCreate([
                'id_periode_laporan' => $bulan->id_periode_laporan,
            ]);

            // Ambil atau buat data periode

            $kuartal = $periode->kuartal;
            $tahun = $periode->tahun;
            $nomorDokumenneraca = "MCTN/LB3/NRC/{$kuartal}/{$tahun}";
            // Set id_status_neraca pada periode
            $periode->update([
                'id_status_neraca' => 1, // Sesuaikan dengan id_status_neraca yang sesuai
                'no_dokumen_neraca' => $nomorDokumenneraca,
            ]);

            return redirect()->route('statuskeluar.index')->with('success', 'Data Neraca Limbah 2 berhasil disubmit.');
        } catch (\Exception $e) {
            return redirect()->route('timk3.showFormNeraca2', $id_bulan)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function showStatusNeraca()
    {
        // Ambil data periode yang memiliki status neraca
        $periodes = PeriodeLaporan::has('statusNeraca')->with('statusNeraca')->get();

        return view('dashboard.timk3.status_neraca', compact('periodes'));
    }
    public function showDetailneraca($id_status_neraca)
    {
        // Ambil data periode berdasarkan id_status_neraca
        $periode = PeriodeLaporan::with('bulan')->find($id_status_neraca);

        // Ambil data neraca limbah 1
        // $neraca1 = NeracaLimbah1::where('id_bulan', $periode->bulan->id_bulan)->first();

        // // Ambil data neraca limbah 2
        // $neraca2 = NeracaLimbah2::where('id_bulan', $periode->bulan->id_bulan)->first();

        return view('dashboard.timk3.detail_periodeneraca', compact('periode'));
    }
    public function detailBulan($id_periode)
    {
        // Ambil data periode
        $periode = PeriodeLaporan::findOrFail($id_periode);

        // Ambil data bulan-bulan yang terkait dengan periode
        $bulans = $periode->bulans;


        return view('dashboard.timk3.detail_bulan', compact('periode', 'bulans'));
    }
    public function kirimNeraca($id)
    {
        $periode = PeriodeLaporan::findOrFail($id);
        // Tambahkan logika lain yang diperlukan
        $periode->update(['id_status_neraca' => 5]);

        return redirect('/timk3/statusneraca');
    }
    public function lihatNeracaPerbulan($id_bulan)
    {
        // Ambil data bulan
        $bulan = BulanModel::findOrFail($id_bulan);

        // Ambil data neraca 1 dan 2 berdasarkan id bulan
        $neraca1 = NeracaLimbah1::where('id_bulan', $id_bulan)->get();
        $neraca2 = NeracaLimbah2::where('id_bulan', $id_bulan)->first();

        return view('dashboard.timk3.lihat_neraca_perbulan', compact('bulan', 'neraca1', 'neraca2'));
    }

    public function editNeraca1($id_neraca1)
    {
        try {
            // Ambil data Neraca 1 berdasarkan ID
            $neraca1 = NeracaLimbah1::findOrFail($id_neraca1);
            $jenisLimbahs = JenisLimbah::all();
            // Kirim data Neraca 1 ke view untuk diedit
            return view('dashboard.timk3.edit_neraca1', compact('neraca1', 'jenisLimbahs'));
        } catch (\Exception $e) {
            // Tangani exception jika terjadi kesalahan
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateNeraca1(Request $request, $id_neraca1)
    {
        try {
            // Validasi request
            $request->validate([
                'id_jenis_limbah' => 'required|exists:jenis_limbahs,id_jenis_limbah',
                'sumber_limbah' => 'required|string',
                'dihasilkan' => 'required|numeric',
                'dimanfaatkan' => 'required|numeric',
                'diolah' => 'required|numeric',
                'ditimbun' => 'required|numeric',
                'diserahkan' => 'required|numeric',
                'eksport' => 'required|numeric',
                'lainnya' => 'required|numeric',
            ]);

            // Ambil data Neraca 1 berdasarkan ID
            $neraca1 = NeracaLimbah1::findOrFail($id_neraca1);

            // Update data Neraca 1
            $neraca1->update([
                'id_jenis_limbah' => $request->id_jenis_limbah,
                'sumber_limbah' => $request->sumber_limbah,
                'dihasilkan' => $request->dihasilkan,
                'dimanfaatkan' => $request->dimanfaatkan,
                'diolah' => $request->diolah,
                'ditimbun' => $request->ditimbun,
                'diserahkan' => $request->diserahkan,
                'eksport' => $request->eksport,
                'lainnya' => $request->lainnya,
            ]);

            return redirect()->route('timk3.lihatNeracaPerbulan', $neraca1->id_bulan)->with('success', 'Data Neraca 1 berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function editNeraca2($id_neraca_limbah_2)
    {
        // Ambil data Neraca 2 berdasarkan ID
        $neraca2 = NeracaLimbah2::find($id_neraca_limbah_2);

        // Anda mungkin perlu mengambil data tambahan yang diperlukan untuk formulir edit

        // Kirim data ke view edit
        return view('dashboard.timk3.edit_neraca2', compact('neraca2'));
    }

    public function updateNeraca2(Request $request, $id)
    {
        // Validasi request
        $request->validate([
            // Atur aturan validasi sesuai kebutuhan
        ]);

        // Update data Neraca 2
        $neraca2 = NeracaLimbah2::find($id);
        $neraca2->update([
            'total_neraca' => $request->total_neraca,
            'residu' => $request->residu,
            'limbah_belum_dikelola' => $request->limbah_belum_dikelola,
            'limbah_tersisa' => $request->limbah_tersisa,
            'kinerja_pengelolaan' => $request->kinerja_pengelolaan,
            'dokumen_kontrol' => $request->dokumen_kontrol,
            'perizinan_limbah_klh' => $request->perizinan_limbah_klh,
            'no_izin_limbah_klh' => $request->no_izin_limbah_klh,
            'catatan' => $request->catatan,
        ]);

        // Redirect ke tampilan Neraca 2 setelah diupdate
        return redirect()->route('timk3.lihatNeracaPerbulan', $neraca2->id_bulan)->with('success', 'Data Neraca 2 berhasil diperbarui.');
    }
}
