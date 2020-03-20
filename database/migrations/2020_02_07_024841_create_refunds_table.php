<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refunds', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('business_time')->comment('业务时间');
            $table->char('refund_no', 128)->comment('退款单号');
            /* $table->char('member_name', 32)->comment('会员姓名'); */
            $table->integer('account_id')->unsigned()->index()->comment('账户id');
            $table->tinyInteger('refund_type')->comment('退款类型：0变更退费，1请假退费，2押金退费，3退院退费，4直接退费');
            $table->decimal('refund_amount', 10, 2)->comment('退款金额');
            $table->tinyInteger('spending_way')->comment('支出方式：0现金，1刷卡，2转账，3微信，4支付宝');
            $table->tinyInteger('refund_status')->comment('退款状态');
            $table->integer('refund_date')->nullable()->comment('退款日期');
            $table->char('agent', 32)->comment('经办人');
            $table->text('note')->comment('备注');
            $table->decimal('real_refund',10, 2)->comment('实际退款');
            $table->decimal('deposit', 10, 2)->comment('存入个人账户');
            $table->char('refund_name', 32)->comment('费用名称');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refunds');
    }
}
