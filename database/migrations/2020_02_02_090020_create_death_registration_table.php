<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeathRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     * 死亡登记表
     * @return void
     */
    public function up()
    {
        Schema::create('death_registration', function (Blueprint $table) {
            $table->increments('id');
            $table->string('member_name', 32)->comment('会员姓名');
            $table->string('member_ID', 24)->comment('身份证号');
            $table->string('family_address', 128)->comment('家庭地址');
            $table->string('contact_number', 16)->comment('联系电话');
            $table->string('check-in_main_diagnosis', 32)->comment('入住主诊断');
            $table->bigInteger('death_time')->comment('死亡时间');
            $table->bigInteger('certificate_time')->comment('开据证明时间');
            $table->string('death_disease', 128)->comment('死亡疾病名称');
            $table->string('certificate_doctor', 32)->comment('开据证明医生');
            //增加删除字段
            $table->tinyInteger('is_del')->comment('是否已经删除 0-未删除 1-已删除')->default(0);
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
        Schema::dropIfExists('death_registration');
    }
}
