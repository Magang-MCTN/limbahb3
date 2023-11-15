<?php

namespace App\Http\Controllers;

use App\Models\JenisLimbah;
use App\Models\LimbahMasuk;
use App\Models\PeriodeLaporan;
use Illuminate\Http\Request;

class TimLb3Controller extends Controller
{
    public function index()
    {
        return view('dashboard.timlb3.index',);
    }
    public function showFormLimbahMasuk()
    {
        return view('dashboard.timlb3.formperiode');
    }

    public function submitFormKuartalTahun(Request $request)
    {
        $request->validate([
            'kuartal' => 'required|string|in:1,2,3,4',
            'tahun' => 'required|numeric|min:4',
        ]);

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

                $periode->update(['no_dokumen_masuk' => $nomorDokumenMasuk]);
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
