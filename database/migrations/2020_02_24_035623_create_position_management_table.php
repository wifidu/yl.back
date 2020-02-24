<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePositionManagementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('position_management', function(Blueprint $table)
		{
			$table->increments('id')->comment('主键id');
			$table->string('position_name', 64)->comment('岗位名称');
			$table->boolean('position_type')->comment('岗位类型(0-行政岗1-财务岗2-护理岗3-管理岗)');
			$table->decimal('position_salary', 10)->comment('岗位薪水(元/每单)');
			$table->string('rank_name', 64)->comment('职级名称');
			$table->decimal('rank_salary', 10)->comment('职级薪水(元/每单)');
			$table->text('position_description', 65535)->nullable()->comment('岗位描述');
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
		Schema::drop('position_management');
	}

}
