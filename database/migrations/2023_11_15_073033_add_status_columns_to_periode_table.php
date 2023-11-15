<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusColumnsToPeriodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('periode_laporans', function (Blueprint $table) {
            // Menambahkan kolom id_status_masuk
            $table->unsignedBigInteger('id_status_masuk')->nullable();
            $table->foreign('id_status_masuk')->references('id_status')->on('statuses');

            // Menambahkan kolom id_status_keluar
            $table->unsignedBigInteger('id_status_keluar')->nullable();
            $table->foreign('id_status_keluar')->references('id_status')->on('statuses');

            // Menambahkan kolom id_status_neraca
            $table->unsignedBigInteger('id_status_neraca')->nullable();
            $table->foreign('id_status_neraca')->references('id_status')->on('statuses');
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
            // Menghapus kolom id_status_masuk
            $table->dropForeign(['id_status_masuk']);
            $table->dropColumn('id_status_masuk');

            // Menghapus kolom id_status_keluar
            $table->dropForeign(['id_status_keluar']);
            $table->dropColumn('id_status_keluar');

            // Menghapus kolom id_status_neraca
            $table->dropForeign(['id_status_neraca']);
            $table->dropColumn('id_status_neraca');
        });
    }
}
