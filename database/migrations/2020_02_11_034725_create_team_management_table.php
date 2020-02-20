<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTeamManagementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('team_management', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('team_name', 64);
			$table->text('service_type');
			$table->text('team_description', 65535);
			$table->text('team_members');
			$table->string('header', 32);
			$table->text('bed_assignment');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('team_management');
	}

}
