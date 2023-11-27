<?php

namespace App\Exports;

use App\Models\LimbahKeluar;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class LimbahKeluarExport implements FromQuery, WithHeadings, ShouldAutoSize, WithEvents
{
    use Exportable;

    private $judul;
    private $limbahKeluar;
    private $tandaTangan;



    public function __construct($judul, $limbahKeluar, $tandaTangan)
    {
        $this->judul = $judul;
        $this->limbahKeluar = $limbahKeluar;
        $this->tandaTangan = $tandaTangan;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Jenis Limbah',
            'Tujuan Penyerahan',
            'Tanggal Keluar',
            'Jumlah Limbah B3 Keluar (KG)',
            'Sisa LB3 di TPS (Ton)',
            'Bukti Nomor Dokumen',
            'Jumlah Ton',
        ];
    }

    public function query()
    {
        return DB::table(DB::raw('(SELECT *, ROW_NUMBER() OVER (ORDER BY tanggal_keluar) AS row_num FROM limbah_keluars) as lim'))
            ->select(
                'lim.row_num as No',
                'jenis_limbahs.jenis_limbah as jenis_limbah',
                'lim.tujuanPenyerahan',
                'lim.tanggal_keluar',
                'lim.jumlahkg',
                'lim.sisa_lb3',
                'lim.buktiNomorDokumen',
                'lim.jumlahton'
            )
            ->leftJoin('jenis_limbahs', 'lim.id_jenis_limbah', '=', 'jenis_limbahs.id_jenis_limbah')
            ->orderBy('lim.tanggal_keluar', 'asc');
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Tambahkan judul di atas data
                $event->sheet->mergeCells('A1:J1');
                $event->sheet->getStyle('A1:J1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                $event->sheet->setCellValue('A1', 'PT. MANDAU CIPTA TENAGA NUSANTARA - NORTH DURI COGEN (' . date('Y') . ')');

                // Baris kosong antara judul dan header kolom
                $event->sheet->append(['']);

                // Mendapatkan kolom terakhir
                $lastColumn = 'J';

                // Mendapatkan baris terakhir
                $lastRow = $event->sheet->getHighestRow();

                // Memasukkan gambar tanda tangan
                if ($this->tandaTangan) {
                    $drawing = new Drawing();
                    $drawing->setName('TandaTangan');
                    $drawing->setDescription('Tanda Tangan');
                    $drawing->setPath(storage_path($this->tandaTangan->path));
                    $drawing->setCoordinates('A' . ($lastRow + 2));
                    $drawing->setWorksheet($event->sheet->getDelegate());
                }

                // Menambahkan informasi lainnya
                if ($this->tandaTangan) {
                    $event->sheet->setCellValue('B' . ($lastRow + 2), 'Nama Ketua: ' . $this->tandaTangan->name);
                    $event->sheet->setCellValue('B' . ($lastRow + 3), 'Jabatan: ' . $this->tandaTangan->jabatan);
                    $event->sheet->setCellValue('B' . ($lastRow + 4), 'Tanggal: ' . now()->format('d/m/Y'));
                }
            },
        ];
    }
}
