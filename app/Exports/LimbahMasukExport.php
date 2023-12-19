<?php

namespace App\Exports;

use Facade\FlareClient\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View as ViewView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;

class LimbahMasukExport implements FromView, ShouldAutoSize
{
    private $judul;
    private $limbahMasuk;
    private $periodes;
    public function __construct($judul, $limbahMasuk, $periodes)
    {
        $this->judul = $judul;
        $this->limbahMasuk = $limbahMasuk;
        $this->periodes = $periodes;
    }

    public function view(): ViewView // Update the return type to Illuminate\View\View
    {
        return view('export.limbah_masuk', [
            'judul' => $this->judul,
            'limbahMasuk' => $this->limbahMasuk,
            'periodes' => $this->periodes,
        ]);
    }
}
