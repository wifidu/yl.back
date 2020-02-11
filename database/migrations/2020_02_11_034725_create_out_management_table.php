<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOutManagementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('out_management', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('member_name', 32)->comment('会员姓名');
			$table->string('bed_number', 64)->comment('床位');
			$table->bigInteger('out_time')->comment('外出时间');
			$table->bigInteger('plan_to_return')->comment('计划返回时间');
			$table->integer('leave_days')->comment('请假天数');
			$table->string('accompany_number', 16)->comment('陪同人电话');
			$table->string('accompany_name', 32)->comment('陪同人姓名');
			$table->text('out_reason', 65535)->comment('外出原因');
			$table->string('register_person', 32)->comment('登记人');
			$table->bigInteger('check-in_time')->comment('登记时间');
			$table->bigInteger('return_time')->comment('返回时间');
			$table->integer('actual_leave_days')->comment('实际请假天数');
			$table->decimal('total', 10)->comment('总计');
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
		Schema::drop('out_management');
	}

}
