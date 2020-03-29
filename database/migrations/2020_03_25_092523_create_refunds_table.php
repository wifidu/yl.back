<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRefundsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('refunds', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('business_time')->comment('业务时间');
			$table->char('refund_no', 128)->comment('退款单号');
			$table->char('member_name', 32)->comment('会员姓名');
			$table->char('beds', 64)->comment('床位');
			$table->boolean('refund_type')->comment('退款类型');
			$table->decimal('refund_amount', 10)->comment('退款金额');
			$table->boolean('refund_status')->comment('退款状态');
			$table->integer('refund_date')->nullable()->comment('退款日期');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('refunds');
	}

}
