<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInventoryManagementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inventory_management', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('inventory_time')->unsigned()->nullable()->comment('盘点时间');
			$table->string('name', 64)->nullable()->comment('盘点名称');
			$table->integer('number')->nullable()->comment('盘点数目');
			$table->decimal('total', 10)->nullable()->comment('合计金额');
			$table->decimal('inventory_losses', 10)->nullable()->comment('盘亏');
			$table->decimal('inventory_surplus', 10)->nullable()->comment('盘盈');
			$table->string('check_person', 32)->nullable()->comment('盘点人');
			$table->integer('completion_time')->unsigned()->nullable()->comment('完成时间');
			$table->boolean('type')->nullable()->comment('盘点完成状态
0-未盘点 1-已盘点');
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
		Schema::drop('inventory_management');
	}

}
