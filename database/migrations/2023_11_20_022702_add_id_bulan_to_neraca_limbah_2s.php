<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdBulanToNeracaLimbah2s extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('neraca_limbah_2s', function (Blueprint $table) {
            $table->foreignId('id_bulan')->nullable()->constrained('bulan', 'id_bulan')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('neraca_limbah_2s', function (Blueprint $table) {
            $table->dropForeign(['id_bulan']);
            $table->dropColumn('id_bulan');
        });
    }
}
