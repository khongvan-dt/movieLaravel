<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateghengoiTable extends Migration
{
    public function up()
    {
        Schema::create('ghe_ngoi', function (Blueprint $table) {
            $table->id('ghe_ngoi_id');
            $table->unsignedBigInteger('Id_rap3');
            $table->string('So_ghe');
            $table->string('Looi_ghe');
            $table->float('price');

            $table->timestamps();
        
            $table->foreign('Id_rap3')->references('rap_chieu_id')->on('rap_chieu');
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('ve');
    }
}
