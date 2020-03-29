<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDepartmentManagementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('department_management', function(Blueprint $table)
		{
			$table->increments('id')->comment('主键id');
			$table->string('department_name', 64)->comment('部门名称');
			$table->text('department_description', 65535)->comment('部门描述');
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
		Schema::drop('department_management');
	}

}
