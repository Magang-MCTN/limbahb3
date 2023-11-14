<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNeracaLimbahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('neraca_limbahs', function (Blueprint $table) {
            $table->id('id_neraca_limbah');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_status');
            $table->unsignedBigInteger('id_periode_laporan');
            $table->unsignedBigInteger('id_neraca_limbah_2')->nullable();
            $table->timestamps();

            // Menambahkan foreign key constraints
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_status')->references('id_status')->on('statuses');
            $table->foreign('id_periode_laporan')->references('id_periode_laporan')->on('periode_laporans');
            $table->foreign('id_neraca_limbah_2')->references('id_neraca_limbah_2')->on('neraca_limbah_2s');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('neraca_limbahs');
    }
}
