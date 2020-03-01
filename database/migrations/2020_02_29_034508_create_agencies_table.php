<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->char('serial_number', 128)->comment('流水号');
            $table->char('business_number', 128)->comment('业务账单');
            $table->tinyInteger('financial_type')->comment('财务类型');
            $table->char('money_flow')->comment('资金流向');
            $table->decimal('transaction_amount', 10, 2)->comment('交易金额');
            $table->tinyInteger('payment_channel')->comment('支付渠道');
            $table->text('note')->comment('备注');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agencies');
    }
}
