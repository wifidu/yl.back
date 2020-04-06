<?php

/*
 * @author weifan
 * Monday 6th of April 2020 10:08:24 AM
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consults', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('time')->comment('访问时间');
            $table->string('consultant', 32)->comment('咨询人');
            $table->string('phone', 16)->comment('咨询人手机号码');
            $table->unsignedTinyInteger('consult_type')->comment('咨询方式，０来访、１电话、２书信');
            $table->string('intention', 64)->comment('咨询意向');
            $table->string('member_name', 32)->comment('会员姓名，老人姓名');
            $table->unsignedInteger('age')->comment('年龄');
            $table->unsignedTinyInteger('selfcare_ability')->comment('自理能力，０自理，１半自理，２失去自理');
            $table->text('note')->comment('备注');
            $table->string('result', 128)->comment('咨询结果');
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
        Schema::dropIfExists('consults');
    }
}
