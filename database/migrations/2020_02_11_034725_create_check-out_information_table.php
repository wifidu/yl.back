<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCheckOutInformationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('check-out_information', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('member_name', 32)->comment('会员姓名');
			$table->string('member_ID', 16)->comment('身份证号');
			$table->string('bed', 64)->comment('床位');
			$table->integer('check-out_time')->comment('退住时间');
			$table->text('check-out_reason', 65535)->comment('退住原因');
			$table->string('manager', 32)->comment('经办人');
			$table->bigInteger('manage_time')->comment('经办时间');
			$table->text('remark', 65535)->comment('备注');
			$table->decimal('account_balance', 10)->comment('账户余额');
			$table->text('expense_item')->comment('费用项目');
			$table->softDeletes()->comment('软删除设置');
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
		Schema::drop('check-out_information');
	}

}
