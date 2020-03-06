<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMaterialOutTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('material_out', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('inventory_id')->unsigned()->nullable()->index('material_out_fk_inventory')->comment('盘点id');
			$table->string('warehouse_name', 64)->nullable()->comment('仓库名称');
			$table->string('out_number', 128)->nullable()->comment('出库单号');
			$table->string('whereabouts', 64)->nullable()->comment('出库去向');
			$table->string('user', 32)->nullable()->comment('领用人');
			$table->integer('out_time')->unsigned()->nullable()->comment('出仓时间');
			$table->string('operator', 32)->nullable()->comment('操作人');
			$table->text('remarks', 65535)->nullable()->comment('备注');
			$table->text('out_material', 65535)->nullable()->comment('出库清单
物资id material_id，入库数量 number，供应商 supplier，有效期 expiry_date');
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
		Schema::drop('material_out');
	}

}
