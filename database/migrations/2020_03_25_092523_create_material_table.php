<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMaterialTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('material', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键(资产编号)');
			$table->string('name', 64)->nullable()->comment('物资名称');
			$table->string('brand', 64)->nullable()->comment('品牌');
			$table->string('model', 64)->nullable()->comment('型号');
			$table->boolean('unit')->nullable()->default(0)->comment('1(0-支 1-个 2-包)');
			$table->integer('number')->unsigned()->nullable()->default(0)->comment('数量');
			$table->string('supplier', 64)->nullable()->comment('供应商');
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
		Schema::drop('material');
	}

}
