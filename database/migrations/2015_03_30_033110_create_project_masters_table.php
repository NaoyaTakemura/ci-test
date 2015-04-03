<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectMastersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_masters', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('company_id')->unsigned();
			$table->string('name');
			$table->char('delete_flag', 1)->default(0);
		});
		Schema::table('project_masters', function(Blueprint $table)
		{
			$table->foreign('company_id')
				->references('id')
				->on('company_masters');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('project_masters');
	}

}
