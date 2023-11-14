<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPengelolaanLb3sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_pengelolaan_lb3s', function (Blueprint $table) {
            $table->id('id_data_pengelolaan_lb3');
            $table->unsignedBigInteger('id_limbah_masuk');
            $table->unsignedBigInteger('id_limbah_keluar');
            $table->unsignedBigInteger('id_neraca_limbah');
            $table->string('no_dokumen', 255);
            $table->string('file_klhk', 255)->nullable();
            $table->string('file_pemda_riau', 255)->nullable();
            $table->string('file_pemda_bengkalis', 255)->nullable();
            $table->unsignedBigInteger('id_status');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_periode');
            $table->timestamps();

            // Menambahkan foreign key constraints
            $table->foreign('id_limbah_masuk')->references('id_limbah_masuk')->on('limbah_masuks');
            $table->foreign('id_limbah_keluar')->references('id_limbah_keluar')->on('limbah_keluars');
            $table->foreign('id_neraca_limbah')->references('id_neraca_limbah')->on('neraca_limbahs');
            $table->foreign('id_status')->references('id_status')->on('statuses');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_periode')->references('id_periode_laporan')->on('periode_laporans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_pengelolaan_lb3s');
    }
}
