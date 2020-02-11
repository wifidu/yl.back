<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePositionManagementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('position_management', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('position_name', 64);
			$table->boolean('position_type');
			$table->decimal('position_salary', 10);
			$table->string('rank_name', 64);
			$table->decimal('rank_salary', 10);
			$table->text('position_description', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('position_management');
	}

}
