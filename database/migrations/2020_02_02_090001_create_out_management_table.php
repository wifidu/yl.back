<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutManagementTable extends Migration
{
    /**
     * Run the migrations.
     * 外出管理表
     * @return void
     */
    public function up()
    {
        Schema::create('out_management', function (Blueprint $table) {
            $table->increments('id');
            $table->string('member_name', 32)->comment('会员姓名');
            $table->string('bed_number', 64)->comment('床位');
            $table->bigInteger('out_time')->comment('外出时间');
            $table->bigInteger('plan_to_return')->comment('计划返回时间');
            $table->integer('leave_days')->comment('请假天数');
            $table->string('accompany_number', 16)->comment('陪同人电话');
            $table->string('accompany_name', 32)->comment('陪同人姓名');
            $table->text('out_reason')->comment('外出原因');
            $table->string('register_person', 32)->comment('登记人');
            $table->bigInteger('check-in_time')->comment('登记时间');
            $table->bigInteger('return_time')->comment('返回时间');
            $table->integer('actual_leave_days')->comment('实际请假天数');
            $table->decimal('total', 10, 2)->comment('总计');
            $table->json('expense_item')->comment('费用项目');
            //增加是否删除字段
            $table->tinyInteger('is_del')->comment('是否已删除  0-未删除 1-已删除')->default(0);
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
        Schema::dropIfExists('out_management');
    }
}
