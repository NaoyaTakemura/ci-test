<?php

use Illuminate\Database\Seeder;

class TaskTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('tasks')->truncate();

		DB::table('tasks')->insert([
			[
				'project_id' => '1',
				'title' => 'テストタスク1',
				'text' => 'テストデータ1',
				'limit' => '2015-10-1 18:00',
				'holder_id' => 1,
				'priority'=> '999',
				'progress' => '0',
			],
		]);
	}

}
