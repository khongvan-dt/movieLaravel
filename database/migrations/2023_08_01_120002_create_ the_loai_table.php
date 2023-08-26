<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTheLoaiTable extends Migration
{
    public function up()
    {
        Schema::create('the_loai', function (Blueprint $table) {
            $table->bigIncrements('the_loai_id');
            $table->string('tenTheLoai', 100)->notNullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('the_loai');
    }
}


