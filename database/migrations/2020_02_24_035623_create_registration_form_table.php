<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegistrationFormTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('registration_form', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('member_name', 32)->comment('会员姓名');
			$table->boolean('care_level')->comment('照护等级 0-全自理 1-轻度依赖 2-中度依赖 3-重度依赖 4-完全依赖 5-临终关怀');
			$table->bigInteger('check-in_time')->comment('入住时间');
			$table->text('bed_cost')->comment('床位费(床位号、房间标准、收费标准)');
			$table->text('meal_cost')->comment('膳食费(类型、套餐名称、收费标准)');
			$table->text('one-time_cost')->comment('一次性费(类型、项目名称、收费标准)');
			$table->softDeletes()->comment('软删除设置');
			$table->timestamps();
			$table->string('medical_port_path', 128)->default('')->comment('体检报告路径');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('registration_form');
	}

}
