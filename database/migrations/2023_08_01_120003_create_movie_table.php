<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovieTable extends Migration
{
    public function up()
    {
        Schema::create('movie', function (Blueprint $table) {
            $table->id('movie_id'); // Use id() method and pass 'movie_id' as the argument
            $table->unsignedBigInteger('the_loai_id');
            $table->string('movie_name', 100);
            $table->string('dao_dien');
            $table->string('dv_chinh');
            $table->string('Max_time');
            $table->string('Ngay_chieu');
            $table->string('img', 500);
            $table->string('description', 1000);
            $table->timestamps();
        
            $table->foreign('the_loai_id')->references('the_loai_id')->on('the_loai');
        });
    }

    public function down()
    {
        Schema::dropIfExists('movie');
    }
};



