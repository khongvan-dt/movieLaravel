<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeTable extends Migration
{
    public function up()
    {
        Schema::create('ve', function (Blueprint $table) {
            $table->id('ve_id');
            $table->unsignedBigInteger('Id_users');
            $table->unsignedBigInteger('ID_ghe2');
            $table->unsignedBigInteger('movie_id3');
            $table->unsignedBigInteger('Id_lich_chieu2');
            $table->float('gia');
            $table->date('Ngay_đat_ve');
            $table->string('thanh_toan');
            $table->timestamps();

            $table->foreign('Id_users')->references('id')->on('users');
            $table->foreign('ID_ghe2')->references('ghe_ngoi_id')->on('ghe_ngoi');
            $table->foreign('movie_id3')->references(' movie_id')->on('movie');
            $table->foreign('Id_lich_chieu2')->references('lich_chieu_id')->on('lich_chieu');
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('ve');
    }
}
