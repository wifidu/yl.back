<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMemberProfileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('member_profile', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('member_name', 32)->comment('会员姓名');
			$table->string('member_ID', 24)->default('')->comment('身份证号');
			$table->boolean('gender')->comment('性别 0-男，1-女');
			$table->string('nation', 8)->default('')->comment('民族');
			$table->integer('height')->comment('身高');
			$table->integer('weight')->comment('体重');
			$table->string('birth_date', 64)->comment('出生日期');
			$table->string('own_system', 64)->comment('所属系统');
			$table->string('sign_doctor', 32)->default('')->comment('签约医生');
			$table->string('community', 64)->default('')->comment('社区');
			$table->string('email', 255)->default('')->comment('邮箱');
			$table->string('phone_number', 16)->comment('手机号');
			$table->string('address', 128)->default('')->comment('地址');
			$table->string('domicile', 128)->default('')->comment('户籍所在地');
			$table->string('avatar_url', 128)->default('')->comment('头像url');
			$table->boolean('is_del')->default(0)->comment('会员是否被删除  0-未删除 1-已删除');
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
		Schema::drop('member_profile');
	}

}
