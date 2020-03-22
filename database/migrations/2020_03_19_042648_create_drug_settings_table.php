<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrugSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('member_name')->comment('会员名称');
            $table->string('bed_number')->comment('床位号');
            $table->text('remark')->comment('备注');
            $table->json('drug_settings')->comment('用药设置');
            $table->softDeletes();
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
        Schema::dropIfExists('drug_settings');
    }
}
