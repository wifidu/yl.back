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
			$table->increments('id')->comment('主键');
			$table->string('team_name', 64)->comment('团队名');
			$table->text('service_type', 65535)->comment('服务类型');
			$table->text('team_description', 65535)->comment('团队描述');
			$table->text('team_members', 65535)->comment('团队成员');
			$table->string('header', 32)->comment('负责人');
			$table->text('bed_assignment', 65535)->comment('床位分配');
			$table->timestamps();
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
