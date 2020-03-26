<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWaitingChargesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('waiting_charges', function(Blueprint $table)
		{
			$table->foreign('member_profile_id', 'waiting_charges_fk__member_profile_id')->references('id')->on('member_profile')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('waiting_charges', function(Blueprint $table)
		{
			$table->dropForeign('waiting_charges_fk__member_profile_id');
		});
	}

}
