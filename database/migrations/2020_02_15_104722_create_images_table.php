<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('images')){
            return;
        }
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->tinyInteger('type')->index();
            $table->string('path')->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('images');
    }
}
