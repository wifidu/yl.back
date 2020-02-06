<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('team_management', function (Blueprint $table) {
            $table->increments('id');
            $table->string('team_name',64);
            $table->json('service_type');
            $table->text('team_description');
            $table->json('team_members');
            $table->string('header',32);
            $table->json('bed_assignment');
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
        Schema::dropIfExists('team_management');
    }
}
