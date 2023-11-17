<?php

namespace App\Http\Controllers;

use App\Models\JenisLimbah;
use App\Models\LimbahMasuk;
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
    public function submitFormLimbahMasuk(Request $request)
    {
        try {

            // $request->validate([
            //     'id_periode_laporan' => 'required|exists:periode_laporans,id_periode_laporan',
            // ]);

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
}
