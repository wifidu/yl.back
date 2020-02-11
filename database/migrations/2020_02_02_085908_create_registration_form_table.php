<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationFormTable extends Migration
{
    /**
     * Run the migrations.
     * 入住登记表迁移
     * @return void
     */
    public function up()
    {
        Schema::create('registration_form', function (Blueprint $table) {
            $table->increments('id');
            $table->string('member_name', 32)->comment('会员姓名');
            $table->tinyInteger('care_level')->comment('照护等级 0-全自理 1-轻度依赖 2-中度依赖 3-重度依赖 4-完全依赖 5-临终关怀');
            $table->bigInteger('check-in_time')->comment('入住时间');
            $table->json('bed_cost')->comment('床位费(床位号、房间标准、收费标准)');
            $table->json('meal_cost')->comment('膳食费(类型、套餐名称、收费标准)');
            $table->json('one-time_cost')->comment('一次性费(类型、项目名称、收费标准)');
            // 增加是否删除字段
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
        Schema::dropIfExists('registration_form');
    }
}
