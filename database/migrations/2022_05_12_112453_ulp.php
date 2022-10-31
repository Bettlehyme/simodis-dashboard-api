<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ulp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ulp', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ulp');
            $table->integer('jumlah_ulp');
            $table->double('target1_ulp');
            $table->double('target2_ulp');
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
        Schema::dropIfExists('ulp');
    }
}
