<?php

namespace Database\Seeders;

use App\Models\JenisLimbah;
use Illuminate\Database\Seeder;

class JenisLimbahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {
        $jenisLimbahData = [
            ['jenis_limbah' => 'Toner bekas (Fotocopy)'],
            ['jenis_limbah' => 'Minyak pelumas bekas antara lain minyak pelumas bekas hidrolik, mesin, gear, fubrikasi, insulasi heat transmision, git, chambers, seperator dan/ atau campuran'],
            ['jenis_limbah' => 'Limbah terkontaminasi B3'],
            ['jenis_limbah' => 'Aki/Baterry Waste'],
            ['jenis_limbah' => 'Kain Majun bekas (Used rags) dan sejenisnya termasuk Ceramic Fiber'],
            ['jenis_limbah' => 'Limbah elektronik termasuk cathoda ray tube(CRT), lampu TL, printed cercuit board (PCB), dan kawat logam'],
            ['jenis_limbah' => 'Bahan Kimia Kadaluarsa dari Laboratorium'],
            ['jenis_limbah' => 'Filter dan absorban bekas (Daur ulang minyak pelumas bekas)'],
            ['jenis_limbah' => 'Kemasan bekas B3'],
        ];

        JenisLimbah::insert($jenisLimbahData);
    }
}
