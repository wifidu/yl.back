<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStaffManagementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('staff_management', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('staff_name', 32);
			$table->boolean('sex');
			$table->string('id_number', 24);
			$table->string('birth_date', 16);
			$table->string('subordinate_department', 64);
			$table->string('subordinate_team', 64);
			$table->string('nation', 8);
			$table->string('position_rank', 64);
			$table->string('phone_number', 64);
			$table->boolean('staff_type');
			$table->integer('start_and_end_time');
			$table->boolean('staff_status');
			$table->string('bank', 128);
			$table->string('bank_card_number', 24);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('staff_management');
	}

}
