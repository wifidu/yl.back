<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrugInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_information', function (Blueprint $table) {
            $table->increments('id');
            $table->string('drug_name', 64)->comment('药品名称');
            $table->tinyInteger('type')->comment('类别：(0-甲类 1-乙类 2-西药)');
            $table->string('factory')->comment('厂家');
            $table->string('specification')->comment('规格');
            $table->tinyInteger('unit')->comment('用药单位(0-支 1-瓶 2-粒)');
            $table->tinyInteger('dosage_form')->comment('剂型(0-片剂 1-针剂)');
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
        Schema::dropIfExists('drug_information');
    }
}
