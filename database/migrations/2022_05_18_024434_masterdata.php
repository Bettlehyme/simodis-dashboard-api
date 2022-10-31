<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Masterdata extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterdata', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_gangguan');
            $table->string('penyulang');
            $table->string('gardu_induk');
            $table->string('area');
            $table->string('rayon');
            $table->string('tgl_padam');
            $table->string('tgl_nyala');
            //sama
            $table->string('j_padam')->nullable();
            $table->string('j_nyala')->nullable();
            $table->string('lama_padam')->nullable();
            // $table->integer('bbn_sebelum')->nullable();
            $table->string('bbn_sebelum')->nullable();
            $table->integer('bbn_setelah')->nullable();

            $table->integer('arus_ggn_r')->nullable();
            $table->integer('arus_ggn_s')->nullable();
            $table->integer('arus_ggn_t')->nullable();
            $table->integer('arus_ggn_n')->nullable();
            $table->integer('ens')->nullable();
            $table->string('indikator_rele');
            $table->string('kel_penyebab');
            $table->string('kode_gangguan');
            $table->string('p_har')->nullable();
            $table->string('titik_pdm');
            $table->string('jenis');
            $table->string('kategori');
            $table->string('keypoint')->nullable();
            //sama
            $table->string('js_padam')->nullable();
            $table->string('js_nyala')->nullable();
            $table->string('lama_padam_sw')->nullable();
            $table->integer('bbn_sw_sebelum')->nullable();
            $table->integer('bbn_sw_setelah')->nullable();

            $table->string('penyebab_pdm');
            $table->string('lokasi_gangguan')->nullable();
            $table->string('trip_tembus')->nullable();
            $table->string('penormalan')->nullable();
            $table->string('kontrol')->nullable();
            $table->string('dispatcher')->nullable();
            $table->string('bulan');
            $table->string('hari');
            $table->string('pdm_5mnt')->nullable();
            $table->double('menit_pdm');
            $table->string('tipe_gangguan');
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
        Schema::dropIfExists('masterdata');
    }
}
