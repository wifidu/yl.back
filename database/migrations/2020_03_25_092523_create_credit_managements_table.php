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
			$table->integer('business_time')->unsigned()->nullable()->comment('业务时间');
			$table->string('voucher_no', 128)->nullable()->comment('收款单号');
			$table->integer('account_id')->nullable()->comment('账户id');
			$table->boolean('payment_type')->nullable()->comment('收款类型，0表示入住收费，1表示变更收费');
			$table->decimal('amount_receivable', 10)->nullable()->comment('应收金额，单位元，保留两位小数');
			$table->decimal('account_balance', 10)->nullable()->comment('账号余额，单位元，保留两位小数');
			$table->integer('billing_date')->unsigned()->nullable()->comment('账单日期');
			$table->boolean('if_pay')->nullable()->comment('是否已经缴费(0-未缴费，1-已缴费)');
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
		Schema::drop('credit_managements');
	}

}
