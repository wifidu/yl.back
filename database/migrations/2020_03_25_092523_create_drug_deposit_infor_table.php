<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDrugDepositInforTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('drug_deposit_infor', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('member_name')->comment('会员姓名');
			$table->string('bed_number')->comment('床位号');
			$table->string('drug_name')->comment('药品名称');
			$table->boolean('unit')->comment('用药单位(0-支 1-瓶 2-粒)');
			$table->integer('surplus_medicine')->comment('剩余药品');
			$table->integer('warning_number')->comment('预警数量');
			$table->softDeletes();
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
		Schema::drop('drug_deposit_infor');
	}

}
