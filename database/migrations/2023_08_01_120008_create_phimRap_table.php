<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatephimRapTable extends Migration
{
    public function up()
    {
        Schema::create('phimRap', function (Blueprint $table) {
            $table->bigIncrements('phimRapId');
            $table->unsignedBigInteger('Id_Rap');
            $table->unsignedBigInteger('ID_Phim');
            $table->foreign('Id_Rap')->references('rap_chieu_id')->on('rap_chieu');
            $table->foreign('ID_Phim')->references('movie_id')->on('movie');
        });
    }

    public function down()
    {
        Schema::dropIfExists('phimRap');
    }
}

