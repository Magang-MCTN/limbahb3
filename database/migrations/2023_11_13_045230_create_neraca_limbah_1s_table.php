<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNeracaLimbah1sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('neraca_limbah_1s', function (Blueprint $table) {
            $table->id('id_neraca_limbah_1');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_periode_laporan');
            $table->string('sumber_limbah', 255);
            $table->unsignedBigInteger('id_jenis_limbah');
            $table->decimal('dihasilkan', 10, 2);
            $table->decimal('dimanfaatkan', 10, 2);
            $table->decimal('diolah', 10, 2);
            $table->decimal('ditimbun', 10, 2);
            $table->decimal('diserahkan', 10, 2);
            $table->decimal('eksport', 10, 2);
            $table->decimal('lainnya', 10, 2);
            $table->timestamps();

            // Menambahkan foreign key constraints
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_periode_laporan')->references('id_periode_laporan')->on('periode_laporans');
            $table->foreign('id_jenis_limbah')->references('id_jenis_limbah')->on('jenis_limbahs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('neraca_limbah_1s');
    }
}
