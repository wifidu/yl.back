<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecipesManagementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recipes_management', function(Blueprint $table)
		{
			$table->increments('id')->comment('主键');
			$table->string('weekly', 64)->nullable()->comment('周次');
			$table->string('package_name', 64)->nullable()->comment('套餐名');
			$table->text('package_detail')->nullable()->comment('套餐详情');
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
		Schema::drop('recipes_management');
	}

}
