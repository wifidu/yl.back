<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeliveryManagementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('delivery_management', function(Blueprint $table)
		{
			$table->increments('id')->comment('主键');
			$table->string('member_name', 32)->nullable()->comment('会员名称');
			$table->string('bed_name', 64)->nullable()->comment('床位名称');
			$table->integer('eat_time')->nullable()->comment('就餐时间');
			$table->string('meal_times', 64)->nullable()->comment('餐次');
			$table->string('dishes_name', 64)->nullable()->comment('菜品名称');
			$table->boolean('dining_style')->nullable()->comment('就餐方式(0-送餐 1-自取)');
			$table->boolean('type')->nullable()->default(0)->comment('状态(0-未就餐 1-配送中 2-已就餐)');
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
		Schema::drop('delivery_management');
	}

}
