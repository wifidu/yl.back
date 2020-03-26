<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accounts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->char('account_number', 128)->comment('账户编号');
			$table->char('member_number', 10)->comment('会员编号');
			$table->char('member_name', 32)->comment('会员姓名');
			$table->char('beds', 64)->nullable()->comment('床位');
			$table->decimal('account_balance', 10)->nullable()->default(0.00)->comment('账户余额');
			$table->decimal('beds_cost', 10)->nullable()->default(0.00)->comment('床位费');
			$table->decimal('meal_cost', 10)->nullable()->default(0.00)->comment('餐费');
			$table->decimal('nursing_cost', 10)->nullable()->default(0.00)->comment('护理费');
			$table->decimal('other_cost', 10)->nullable()->default(0.00)->comment('其他月度费');
			$table->decimal('meal_cost_left', 10)->nullable()->default(0.00)->comment('剩余膳食费');
			$table->decimal('beds_cost_left', 10)->nullable()->default(0.00)->comment('剩余床位费');
			$table->decimal('nursing_cost_left', 10)->nullable()->default(0.00)->comment('剩余护理费');
			$table->decimal('other_cost_left', 10)->nullable()->default(0.00)->comment('剩余其他月度费');
			$table->integer('beds_cost_start_time')->unsigned()->nullable()->comment('床位费生效时间');
			$table->integer('meal_cost_start_time')->unsigned()->nullable()->comment('膳食费生效时间');
			$table->integer('nursing_cost_start_time')->unsigned()->nullable()->comment('护理费生效时间');
			$table->integer('other_cost_start_time')->unsigned()->nullable()->comment('其他月度费生效时间');
			$table->decimal('deposit', 10)->nullable()->default(0.00)->comment('押金');
			$table->string('cd_card', 30)->nullable()->comment('身份证号码');
			$table->boolean('is_check-out')->nullable()->default(0)->comment('是否退住(0-未退住 1-已退住) 默认为0');
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
		Schema::drop('accounts');
	}

}
