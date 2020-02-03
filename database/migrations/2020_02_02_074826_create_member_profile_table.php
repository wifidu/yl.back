<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberProfileTable extends Migration
{
    /**
     * Run the migrations.
     * 生成会员档案表
     * @return void
     */
    public function up()
    {
        Schema::create('member_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->string('member_name', 32)->comment('会员姓名');
            $table->string('member_ID', 24)->comment('身份证号');
            $table->tinyInteger('gender')->comment('性别 0-男，1-女');
            $table->string('nation', 8)->comment('民族');
            $table->integer('height')->comment('身高');
            $table->integer('weight')->comment('体重');
            $table->string('birth_date', 16)->comment('出生日期');
            $table->string('own_system', 32)->comment('所属系统');
            $table->string('sign_doctor', 32)->comment('签约医生');
            $table->string('community', 64)->comment('社区');
            $table->string('email', 32)->comment('邮箱');
            $table->string('phone_number', 16)->comment('手机号');
            $table->string('address', 128)->comment('地址');
            $table->string('domicile', 128)->comment('户籍所在地');
            $table->string('avatar_url', 128)->comment('头像url');
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
        Schema::dropIfExists('member_profile');
    }
}
