<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLimbahKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('limbah_keluars', function (Blueprint $table) {
            $table->id('id_limbah_keluar');
            $table->date('tanggal_keluar');
            $table->unsignedBigInteger('id_jenis_limbah');
            $table->decimal('jumlahkg', 10, 2);
            $table->decimal('jumlahton', 10, 2);
            $table->string('tujuanPenyerahan', 255);
            $table->string('buktiNomorDokumen', 255);
            $table->decimal('sisa_lb3', 10, 2);
            $table->unsignedBigInteger('id_status');
            $table->unsignedBigInteger('id_periode_laporan');
            $table->unsignedBigInteger('id_user');
            $table->string('alasan_limbah_keluar', 255)->nullable();
            $table->timestamps();

            // Menambahkan foreign key constraints
            $table->foreign('id_jenis_limbah')->references('id_jenis_limbah')->on('jenis_limbahs');
            $table->foreign('id_status')->references('id_status')->on('statuses');
            $table->foreign('id_periode_laporan')->references('id_periode_laporan')->on('periode_laporans');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('limbah_keluars');
    }
}
