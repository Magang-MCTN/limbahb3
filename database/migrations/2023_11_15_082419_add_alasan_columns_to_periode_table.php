<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlasanColumnsToPeriodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('periode_laporans', function (Blueprint $table) {
            $table->string('alasan_limbah_masuk', 255)->nullable();


            // Menambahkan kolom id_status_keluar
            $table->string('alasan_limbah_keluar', 255)->nullable();


            // Menambahkan kolom id_status_neraca
            $table->string('alasan_limbah_neraca', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('periode_laporans', function (Blueprint $table) {
            $table->dropColumn('alasan_limbah_neraca');
            $table->dropColumn('alasan_limbah_masuk');
            $table->dropColumn('alasan_limbah_keluar');
        });
    }
}
