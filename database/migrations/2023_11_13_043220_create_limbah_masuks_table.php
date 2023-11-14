<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLimbahMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('limbah_masuks', function (Blueprint $table) {
            $table->id('id_limbah_masuk');
            $table->unsignedBigInteger('id_jenis_limbah');
            $table->date('tanggal_masuk');
            $table->string('satuan_limbah', 255);
            $table->string('sumber_limbahB3', 255);
            $table->string('bentuk_limbahB3', 255);
            $table->date('maksimal_penyimpanan');
            $table->decimal('jumlah_limbah', 10, 2);
            $table->decimal('berat_satuan', 10, 2);
            $table->decimal('berat', 10, 2);
            $table->unsignedBigInteger('id_status');
            $table->unsignedBigInteger('id_periode_laporan');
            $table->unsignedBigInteger('id_user');
            $table->string('alasan_limbah_masuk', 255)->nullable();
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
        Schema::dropIfExists('limbah_masuks');
    }
}
