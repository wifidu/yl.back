<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePackageManagementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('package_management', function(Blueprint $table)
		{
			$table->increments('id')->comment('主键');
			$table->string('package_name', 64)->comment('套餐名称');
			$table->decimal('package_price', 10)->comment('套餐价格');
			$table->integer('reserve_number')->nullable()->default(0)->comment('订餐人数');
			$table->text('package_describe', 65535)->nullable()->comment('套餐描述');
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
		Schema::drop('package_management');
	}

}
