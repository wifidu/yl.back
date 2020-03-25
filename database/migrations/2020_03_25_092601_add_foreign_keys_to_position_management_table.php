<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPositionManagementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('position_management', function(Blueprint $table)
		{
			$table->foreign('role_id', 'position_management_fk_roles')->references('id')->on('roles')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('position_management', function(Blueprint $table)
		{
			$table->dropForeign('position_management_fk_roles');
		});
	}

}
