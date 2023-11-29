<?php

namespace App\Exports;

use App\Models\Neraca1;
use App\Models\Neraca2;
use App\Models\NeracaLimbah1;
use App\Models\NeracaLimbah2;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NeracaExport implements FromCollection, WithHeadings
{
    private $id_periode_laporan;

    public function __construct($id_periode_laporan)
    {
        $this->id_periode_laporan = $id_periode_laporan;
    }

    public function headings(): array
    {
        return [
            'Bulan',
            'Aset Neraca 1',
            'Kewajiban Neraca 1',
            'Aset Neraca 2',
            'Kewajiban Neraca 2',
            // ... tambahkan kolom-kolom neraca lainnya
        ];
    }

    public function collection()
    {
        // Ambil data Neraca1 dan Neraca2 sesuai dengan periode laporan
        $neraca1 = NeracaLimbah1::whereHas('bulan', function ($query) {
            $query->where('id_periode_laporan', $this->id_periode_laporan);
        })->get();

        $neraca2 = NeracaLimbah2::whereHas('bulan', function ($query) {
            $query->where('id_periode_laporan', $this->id_periode_laporan);
        })->get();

        // Gabungkan data Neraca1 dan Neraca2 ke dalam satu koleksi
        $combinedData = collect();

        foreach ($neraca1 as $item) {
            $combinedData->push([
                'bulan' => $item->bulan->nama_bulan,
                'aset_neraca1' => $item->aset,
                'kewajiban_neraca1' => $item->kewajiban,
                'aset_neraca2' => $this->getAsetNeraca2($item->bulan, $neraca2),
                'kewajiban_neraca2' => $this->getKewajibanNeraca2($item->bulan, $neraca2),
                // ... tambahkan kolom-kolom neraca lainnya
            ]);
        }

        return $combinedData;
    }

    // Fungsi bantu untuk mendapatkan data Aset Neraca2
    private function getAsetNeraca2($bulan, $neraca2)
    {
        $item = $neraca2->where('bulan_id', $bulan->id)->first();
        return $item ? $item->aset : null;
    }

    // Fungsi bantu untuk mendapatkan data Kewajiban Neraca2
    private function getKewajibanNeraca2($bulan, $neraca2)
    {
        $item = $neraca2->where('bulan_id', $bulan->id)->first();
        return $item ? $item->kewajiban : null;
    }
}
