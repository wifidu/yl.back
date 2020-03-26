<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStaffManagementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('staff_management', function(Blueprint $table)
		{
			$table->increments('id')->comment('主键id');
			$table->integer('user_id')->unsigned()->nullable()->index('staff_management_fk_users')->comment('用户id');
			$table->string('staff_name', 32)->comment('员工姓名');
			$table->boolean('sex')->comment('性别(0-男 1-女)');
			$table->string('id_number', 24)->comment('身份证号');
			$table->string('birth_date', 16)->comment('出生日期');
			$table->string('subordinate_department', 64)->comment('所属部门');
			$table->string('subordinate_team', 64)->comment('所属团队');
			$table->string('nation', 8)->comment('民族');
			$table->string('position_rank', 64)->comment('岗位职级');
			$table->string('phone_number', 64)->comment('电话号码');
			$table->boolean('staff_type')->comment('员工类型(0-劳动合同工 1-临时工)
');
			$table->integer('start_time')->unsigned()->comment('合同开始时间');
			$table->integer('end_time')->unsigned()->comment('合同结束时间');
			$table->boolean('staff_status')->comment('员工状态(0-在职 1-离职)');
			$table->string('bank', 128)->comment('开户行');
			$table->string('bank_card_number', 24)->comment('银行卡号');
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
		Schema::drop('staff_management');
	}

}
