<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMonthlyChargesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('monthly_charges', function(Blueprint $table)
		{
			$table->foreign('waiting_charges_id', 'monthly_charges_fk_waiting_charges_id')->references('id')->on('waiting_charges')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('monthly_charges', function(Blueprint $table)
		{
			$table->dropForeign('monthly_charges_fk_waiting_charges_id');
		});
	}

}
