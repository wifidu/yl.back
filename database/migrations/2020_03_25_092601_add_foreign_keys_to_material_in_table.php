<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMaterialInTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('material_in', function(Blueprint $table)
		{
			$table->foreign('inventory_id', 'material_in_fk_inventory')->references('id')->on('inventory_management')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('material_in', function(Blueprint $table)
		{
			$table->dropForeign('material_in_fk_inventory');
		});
	}

}
