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
            $table->char('member_name', 32)->comment('会员姓名');
            $table->char('beds', 64)->comment('床位');
            $table->tinyInteger('refund_type')->comment('退款类型');
            $table->decimal('refund_amount', 10, 2)->comment('退款金额');
            $table->tinyInteger('refund_status')->comment('退款状态');
            $table->integer('refund_date')->nullable()->comment('退款日期');
        });
    }

    /**
            $table-><++>;
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refunds');
    }
}
