<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('staff_management', function (Blueprint $table) {
            $table->increments('id');
            $table->string('staff_name',32);
            $table->tinyInteger('sex');
            $table->string('id_number',24);
            $table->string('birth_date',16);
            $table->string('subordinate_department',64);
            $table->string('subordinate_team',64);
            $table->string('nation',8);
            $table->string('position_rank',64);
            $table->string('phone_number',64);
            $table->tinyInteger('staff_type');
            $table->integer('start_and_end_time');
            $table->tinyInteger('staff_status');
            $table->string('bank',128);
            $table->string('bank_card_number',24);
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
        Schema::dropIfExists('staff_management');
    }
}
