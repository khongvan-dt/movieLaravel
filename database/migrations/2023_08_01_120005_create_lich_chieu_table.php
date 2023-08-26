<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLichChieuTable extends Migration
{

    public function up()
    {
        Schema::create('lich_chieu', function (Blueprint $table) {
            $table->id('lich_chieu_id');
            $table->unsignedBigInteger('movie_id2');
            $table->unsignedBigInteger('Id_rap2');
            $table->datetime('ngayChieu');
            $table->string('strat');
            $table->string('end');
            // $table->timestamps();
            $table->foreign('movie_id2')->references('movie_id')->on('movie');
            $table->foreign('Id_rap2')->references('rap_chieu_id')->on('rap_chieu');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lich_chieu');
    }
}
