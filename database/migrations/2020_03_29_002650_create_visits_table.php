<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('visitor', 32)->comment('访问人姓名');
            $table->string('phone', 16)->comment('访问人的电话');
            $table->unsignedInteger('visit_time')->comment('访问的时间');
            $table->string('member_name', 32)->index()->comment('访问的对象');
            $table->text('visit_reason')->comment('访问原因');
            $table->string('beds', 64)->comment('床位');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visits');
    }
}
