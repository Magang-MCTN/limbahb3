<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;

class LimbahMasukExport implements FromQuery, WithHeadings, ShouldAutoSize, WithEvents
{
    use Exportable;

    private $judul;
    private $limbahMasuk;

    public function __construct($judul, $limbahMasuk)
    {
        $this->judul = $judul;
        $this->limbahMasuk = $limbahMasuk;
    }

    public function headings(): array
    {
        return [
            'No',
            'Jenis Limbah B3',
            'Satuan Limbah',
            'Tanggal Masuk Limbah B3',
            'Sumber Limbah B3',
            'Bentuk Limbah B3',
            'Maksimal Penyimpanan (180-360 hr)',
            'Jumlah',
            'Berat/Satuan',
            'Berat (kg)',
        ];
    }


    public function query()
    {
        return DB::table(DB::raw('(SELECT *, ROW_NUMBER() OVER (ORDER BY tanggal_masuk) AS row_num FROM limbah_masuks) as lim'))
            ->select(
                'lim.row_num as No',

                'jenis_limbahs.jenis_limbah as jenis_limbah',
                'lim.satuan_limbah',
                'lim.tanggal_masuk',
                'lim.sumber_limbahB3',
                'lim.bentuk_limbahB3',
                'lim.maksimal_penyimpanan',
                'lim.jumlah_limbah',
                'lim.berat_satuan',
                'lim.berat'
            )
            ->leftJoin('jenis_limbahs', 'lim.id_jenis_limbah', '=', 'jenis_limbahs.id_jenis_limbah')
            ->orderBy('lim.tanggal_masuk', 'asc');
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                // Membuat judul di atas data
                $event->sheet->mergeCells('A1:J1');
                $event->sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'size' => 16,
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $event->sheet->setCellValue('A1', $this->judul);

                // Menambahkan baris kosong setelah judul
                $event->sheet->insertNewRowBefore(2, 1);
            },

            AfterSheet::class => function (AfterSheet $event) {
                // Menambahkan baris kosong setelah header kolom
                $event->sheet->insertNewRowBefore(2, 1);
            },
        ];
    }
}
