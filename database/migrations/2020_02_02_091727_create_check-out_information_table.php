<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckOutInformationTable extends Migration
{
    /**
     * Run the migrations.
     * 退住信息表
     * @return void
     */
    public function up()
    {
        Schema::create('check-out_information', function (Blueprint $table) {
            $table->increments('id');
            $table->string('member_name', 32)->comment('会员姓名');
            $table->string('member_ID', 16)->comment('身份证号');
            $table->string('bed', 64)->comment('床位');
            $table->integer('check-out_time')->comment('退住时间');
            $table->text('check-out_reason')->comment('退住原因');
            $table->string('manager', 32)->comment('经办人');
            $table->bigInteger('manage_time')->comment('经办时间');
            $table->text('remark')->comment('备注');
            $table->decimal('account_balance', 10, 2)->comment('账户余额');
            $table->json('expense_item')->comment('费用项目');
            //增加是否删除字段
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
        Schema::dropIfExists('check-out_information');
    }
}
