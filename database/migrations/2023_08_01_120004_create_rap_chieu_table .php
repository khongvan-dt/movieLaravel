<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRapChieuTable extends Migration
{
    public function up()
    {
        Schema::create('rap_chieu', function (Blueprint $table) {
            $table->id('rap_chieu_id'); 
            $table->string('Name_rap');
            $table->string('adress');
            $table->string('sdt');
            $table->string('Email');
            $table->string('Website');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rap_chieu');
    }
};

