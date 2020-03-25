<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWarehouseLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('warehouse_log', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('odd_number', 128)->nullable()->comment('单号');
			$table->boolean('type')->nullable()->comment('(0-盘点 1-出库 2-入库)');
			$table->string('warehouse_name', 64)->nullable()->comment('仓库名称');
			$table->string('material_name', 64)->nullable()->comment('物资名称');
			$table->string('brand', 64)->nullable()->comment('品牌规格');
			$table->string('supplier', 64)->nullable()->comment('供应商');
			$table->boolean('unit')->nullable()->comment('(0-支 1-个 2-包)');
			$table->decimal('price', 10)->nullable()->comment('单价');
			$table->integer('number')->nullable()->comment('数量');
			$table->decimal('total', 10)->nullable()->comment('金额');
			$table->string('operator', 32)->nullable()->comment('操作人');
			$table->integer('operator_time')->unsigned()->nullable()->comment('变动时间');
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
		Schema::drop('warehouse_log');
	}

}
