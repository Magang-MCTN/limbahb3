<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\View\View as ViewView;
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

class LimbahKeluarExport implements FromView, ShouldAutoSize
{
    private $judul;
    private $limbahkeluar;
    private $tandaTangan;
    private $periodes;

    public function __construct($judul, $limbahkeluar, $tandaTangan, $periodes)
    {
        $this->judul = $judul;
        $this->limbahkeluar = $limbahkeluar;
        $this->tandaTangan = $tandaTangan;
        $this->periodes = $periodes;
    }

    public function view(): ViewView // Update the return type to Illuminate\View\View
    {
        return view('export.limbah_keluar', [
            'judul' => $this->judul,
            'limbahkeluar' => $this->limbahkeluar,
            'tandaTangan' => $this->tandaTangan,
            'periodes' => $this->periodes,
        ]);
    }
}
