<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accidents', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('account_id')->unsigned()->index()->comment('账户id');
            $table->tinyInteger('level_accident')->comment('事故等级, 0-轻微 1-一般　２-严重');
            $table->unsignedInteger('type_id')->comment('事故类型id');
            $table->integer('occurrence_time')->comment('发生时间');
            $table->string('duty_personnel', 128)->comment('值班人员');
            $table->string('head', 32)->comment('负责人');
            $table->text('description')->comment('事故描述');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accidents');
    }
}
