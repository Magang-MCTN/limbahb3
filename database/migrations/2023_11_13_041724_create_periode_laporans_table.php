<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodeLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periode_laporans', function (Blueprint $table) {
            $table->id('id_periode_laporan');
            $table->string('bulan', 255);
            $table->string('tahun', 255);
            $table->string('kuartal', 255);
            $table->string('keterangan_kuartal', 255)->nullable();
            $table->string('no_dokumen_masuk', 255)->nullable();
            $table->string('no_dokumen_keluar', 255)->nullable();
            $table->string('no_dokumen_neraca', 255)->nullable();
            $table->timestamps(); // Ini akan membuat kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('periode_laporans');
    }
}
