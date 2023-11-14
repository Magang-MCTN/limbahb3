<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNeracaLimbah2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('neraca_limbah_2s', function (Blueprint $table) {
            $table->id('id_neraca_limbah_2');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_periode_laporan');
            $table->decimal('total_neraca', 10, 2);
            $table->decimal('residu', 10, 2);
            $table->decimal('limbah_belum_dikelola', 10, 2);
            $table->decimal('limbah_tersisa', 10, 2);
            $table->decimal('kinerja_pengelolaan', 10, 2);
            $table->string('dokumen_kontrol', 255);
            $table->enum('perizinan_limbah_klh', ['Sudah', 'Belum'])->default('Belum');
            $table->string('no_izin_limbah_klh', 255);
            $table->text('catatan')->nullable();
            $table->timestamps();

            // Menambahkan foreign key constraints
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_periode_laporan')->references('id_periode_laporan')->on('periode_laporans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('neraca_limbah_2s');
    }
}
