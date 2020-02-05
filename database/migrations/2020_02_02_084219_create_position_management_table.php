<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('position_management', function (Blueprint $table) {
            $table->increments('id');
            $table->string('position_name',64);
            $table->tinyInteger('position_type');
            $table->decimal('position_salary',10,2);
            $table->string('rank_name',64);
            $table->decimal('rank_salary',10,2);
            $table->text('position_description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('position_management');
    }
}
