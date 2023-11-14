<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['nama_role' => 'tim_lb3', 'keterangan_role' => 'Tim Limbah B3'],
            ['nama_role' => 'tim_k3', 'keterangan_role' => 'Tim K3'],
            ['nama_role' => 'Specialist_OpHar', 'keterangan_role' => 'Speasialis Operasi Pemeliharaan'],
            ['nama_role' => 'ketua_OpHar', 'keterangan_role' => 'Ketua Operasi Pemeliharaan'],
            ['nama_role' => 'admin_lobby', 'keterangan_role' => 'Admin Lobby'],
            ['nama_role' => 'administrator', 'keterangan_role' => 'Administrator'],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert($role);
        }
    }
}
