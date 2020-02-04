<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFixedAssetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fixed_assets', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键(资产编号)');
			$table->string('name', 64)->nullable()->comment('资产名称');
			$table->string('classification', 64)->nullable()->comment('分类');
			$table->string('serial_number', 256)->nullable()->comment('序列号');
			$table->string('brand', 64)->nullable()->comment('品牌');
			$table->string('position', 64)->nullable()->comment('位置');
			$table->string('model', 64)->nullable()->comment('型号');
			$table->string('department', 64)->nullable()->comment('部门');
			$table->string('administrators', 32)->nullable()->comment('负责人');
			$table->decimal('price', 10)->nullable()->comment('金额');
			$table->boolean('type')->nullable()->comment('状态');
			$table->integer('install_date')->nullable()->comment('安装时间');
			$table->integer('warranty')->nullable()->comment('保修期');
			$table->text('remarks', 65535)->nullable()->comment('备注');
			$table->string('picture_url', 128)->nullable()->comment('图片url');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fixed_assets');
	}

}
