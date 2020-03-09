<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFoodManagementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('food_management', function(Blueprint $table)
		{
			$table->increments('id')->comment('主键');
			$table->string('food_name', 64)->comment('单品名称');
			$table->decimal('food_price', 10)->comment('价格');
			$table->boolean('food_type')->comment('状态 0-下架中 1-上架中');
			$table->string('subordinate_species', 64)->comment('所属种类');
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
		Schema::drop('food_management');
	}

}
