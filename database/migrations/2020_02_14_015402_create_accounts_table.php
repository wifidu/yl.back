<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->char('account_number', 128)->comment('账户编号');
            $table->char('member_number', 10)->comment('会员编号');
            $table->char('member_name', 32)->comment('会员姓名');
            $table->char('beds', 64)->comment('床位');
            $table->decimal('account_balance', 10, 2)->comment('账户余额');
            $table->decimal('beds_cost', 10, 2)->comment('床位费');
            $table->decimal('meal_cost', 10, 2)->comment('餐费');
            $table->decimal('nursing_cost', 10, 2)->comment('护理费');
            $table->decimal('other_cost', 10, 2)->comment('其他月度费');
            $table->char('cd_card', 24)->comment('身份证');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
