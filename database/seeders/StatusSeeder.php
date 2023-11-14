<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['nama' => 'Draft'],
            ['nama' => 'Menunggu Persetujuan'],
            ['nama' => 'Disetujui'],
            ['nama' => 'Ditolak'],
            ['nama' => 'Menunggu Review Specialist OpHar'],
        ];

        foreach ($statuses as $status) {
            DB::table('statuses')->insert($status);
        }
    }
}
