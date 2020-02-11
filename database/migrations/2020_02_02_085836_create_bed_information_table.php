<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBedInformationTable extends Migration
{
    /**
     * Run the migrations.
     * 床位信息表
     * @return void
     */
    public function up()
    {
        Schema::create('bed_information', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bed_number', 64)->comment('床位号')->default('');
            $table->decimal('bed_cost', 10, 2)->comment('床位费用');
            $table->bigInteger('check-in_date')->comment('入住日期');
            $table->decimal('appoint_deposit', 10, 2)->comment('预约押金')->default(0.0);
            $table->string('contract_number', 16)->comment('联系电话');
            $table->string('appoint_person', 32)->comment('预约人');
            $table->bigInteger('appoint_time')->comment('预约时间')->default(0);
            $table->string('elderly_name', 32)->comment('老人姓名');
            $table->string('elderly_ID', 24)->comment('老人身份证号')->default('');
            $table->integer('elderly_age')->comment('老人年龄')->default(0);
            $table->tinyInteger('elderly_gender')->comment('老人性别 0-男 1-女');
            $table->tinyInteger('self-care_ability')->comment('自理能力 0-自理 1-半自理 2-失能');
            $table->string('address', 128)->comment('居住地址')->default('');
            $table->text('remark')->comment('备注');

            //新增是否入住和是否取消入住字段
            $table->tinyInteger('is_checkin')->comment('是否入住 0-未入住 1-已入住')->default(0);
            $table->tinyInteger('is_cancel')->comment('是否取消入住 0-未取消 1-已取消 ')->default(0);

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
        Schema::dropIfExists('bed_information');
    }
}
