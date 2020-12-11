<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMaterialInTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('material_in', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('material_id')->unsigned()->default(0)->index();
            $table->integer('amount')->unsigned()->nullable()->default(1)->comment('数量');
            $table->integer('inventory_id')->unsigned()->nullable()->comment('盘点id');
			$table->string('in_number', 32)->nullable()->comment('入库单号');
			$table->string('warehouse_name', 64)->nullable()->comment('仓库名称');
			$table->string('origin', 64)->nullable()->comment('来源');
			$table->string('batch_number', 128)->nullable()->comment('批号');
			$table->integer('in_time')->unsigned()->nullable()->comment('入库时间');
			$table->string('operator', 32)->nullable()->comment('操作人');
			$table->text('remarks', 65535)->nullable()->comment('备注');
			// $table->text('in_material', 65535)->nullable()->comment('入库物资，形式
// 物资id material_id，入库数量 number，供应商 supplier，有效期 expiry_date');
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
		Schema::drop('material_in');
	}

}
