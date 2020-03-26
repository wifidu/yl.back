<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAgenciesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('agencies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->char('serial_number', 128)->comment('流水号');
			$table->char('business_number', 128)->comment('业务账单');
			$table->boolean('financial_type')->comment('财务类型');
			$table->char('money_flow')->comment('资金流向');
			$table->decimal('transaction_amount', 10)->comment('交易金额');
			$table->boolean('payment_channel')->comment('支付渠道');
			$table->text('note', 65535)->comment('备注');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('agencies');
	}

}
