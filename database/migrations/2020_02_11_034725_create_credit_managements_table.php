<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCreditManagementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('credit_managements', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('business_time')->comment('业务时间');
			$table->char('voucher_no', 128)->comment('收款单号');
			/* $table->char('member_name', 32)->comment('会员名称'); */
      $table->integer('account_id')->comment('账户id');
			$table->boolean('payment_type')->comment('收款类型，0表示入住收费，1表示变更收费');
			$table->decimal('amount_receivable', 10)->comment('应收金额，单位元，保留两位小数');
			$table->decimal('account_balance', 10)->comment('账号余额，单位元，保留两位小数');
			$table->integer('billing_date')->comment('账单日期');
			$table->boolean('if_pay')->comment('是否已经缴费');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('credit_managements');
	}

}
