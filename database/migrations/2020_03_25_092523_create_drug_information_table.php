<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDrugInformationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('drug_information', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('drug_name', 64)->comment('药品名称');
			$table->boolean('type')->comment('类别：(0-甲类 1-乙类 2-西药)');
			$table->string('factory')->comment('厂家');
			$table->string('specification')->comment('规格');
			$table->boolean('unit')->comment('用药单位');
			$table->boolean('dosage_form')->comment('剂型');
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
		Schema::drop('drug_information');
	}

}
