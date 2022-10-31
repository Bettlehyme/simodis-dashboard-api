<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetaileventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailevents', function (Blueprint $table) {
            $table->id();
            $table->string('no_lapor');
            $table->string('kode');
            $table->string('jenis');
            $table->string('ulp');
            $table->string('penyulang');
            $table->string('tgl_padam');
            $table->string('jam_padam');
            $table->date('tgl_nyala');
            $table->string('jam_nyala');
            $table->integer('pelanggan_padam');
            $table->double('durasi_padam');
            $table->double('jam_pelanggan_padam'); // hasil kali durasi padam dengan jumlah pelanggan padam
            $table->integer('ens');
            $table->double('SAIDI')->nullable();
            $table->double('SAIFI')->nullable();
            $table->double('plg_ulp')->nullable();
            $table->double('saidi_ulp')->nullable();
            $table->double('saifi_ulp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detailevents');
    }
}
