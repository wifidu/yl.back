<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWaitingChargesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('waiting_charges', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('member_profile_id')->unsigned()->nullable()->index('waiting_charges_fk__member_profile_id')->comment('会员档案id');
			$table->string('bed_number', 64)->nullable()->comment('床位编号');
			$table->string('member_name', 32)->nullable()->comment('姓名');
			$table->integer('refund_time')->unsigned()->nullable()->comment('退款时间');
			$table->integer('charges_time')->unsigned()->nullable()->comment('收款时间');
			$table->decimal('beds_cost', 10)->nullable()->default(0.00)->comment('床位费');
			$table->decimal('nursing_cost', 10)->nullable()->default(0.00)->comment('护理费');
			$table->decimal('risk_insurance', 10)->nullable()->default(0.00)->comment('抵长护险');
			$table->decimal('meal_cost', 10)->nullable()->default(0.00)->comment('膳食费');
			$table->decimal('deposit', 10)->nullable()->default(0.00)->comment('押金');
			$table->decimal('incidental', 10)->nullable()->default(0.00)->comment('杂费');
			$table->decimal('other_cost', 10)->nullable()->default(0.00)->comment('一次性费用');
			$table->string('invoice_number', 128)->nullable()->comment('发票号');
			$table->decimal('invoice_expenses', 10)->nullable()->default(0.00)->comment('开票费用');
			$table->decimal('total_expenses', 10)->nullable()->default(0.00)->comment('合计费用');
			$table->text('mark', 65535)->nullable()->comment('备注');
			$table->boolean('is_ charges')->nullable()->default(0)->comment('收款状态(0-未收款 1-已收款)');
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
		Schema::drop('waiting_charges');
	}

}
