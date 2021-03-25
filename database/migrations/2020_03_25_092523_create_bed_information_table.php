<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBedInformationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bed_information', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('bed_number', 64)->default('')->comment('床位号');
			$table->decimal('bed_cost', 10)->comment('床位费用');
			$table->bigInteger('check-in_date')->comment('入住日期');
			$table->decimal('appoint_deposit', 10)->default(0.00)->comment('预约押金');
			$table->string('contract_number', 16)->comment('联系电话');
			$table->string('appoint_person', 32)->comment('预约人');
			$table->bigInteger('appoint_time')->default(0)->comment('预约时间');
			$table->string('name', 32)->comment('姓名');
			// $table->string('ID', 24)->default('')->nullable()->comment('身份证号');
			$table->integer('age')->default(0)->comment('老人年龄');
			$table->boolean('gender')->comment('性别 0-男 1-女');
			$table->boolean('self-care_ability')->comment('自理能力 0-自理 1-半自理 2-失能');
			$table->string('address', 128)->default('')->comment('居住地址');
			$table->text('remark', 65535)->comment('备注');
			$table->boolean('is_checkin')->default(0)->comment('是否入住 0-未入住 1-已入住');
			$table->boolean('is_cancel')->default(0)->comment('是否取消入住 0-未取消 1-已取消 ');
			$table->softDeletes()->comment('软删除设置');
            $table->integer('account_id')->comment('对应账户ｉｄ');
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
		Schema::drop('bed_information');
	}

}
