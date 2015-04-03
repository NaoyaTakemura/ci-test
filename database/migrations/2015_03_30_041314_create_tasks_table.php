<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tasks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('project_id')->unsigned();
			$table->string('title');
			$table->text('text');
			$table->timestamp('limit');
			$table->string('progress');
			$table->char('delete', 1)->default(0);
			
		});
		Schema::table('tasks', function(Blueprint $table)
		{
			$table->foreign('project_id')
				->references('id')
				->on('project_masters');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tasks');
	}

}
