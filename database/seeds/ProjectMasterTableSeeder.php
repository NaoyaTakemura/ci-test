<?php

use Illuminate\Database\Seeder;

class ProjectMasterTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('project_masters')->truncate();

		DB::table('project_masters')->insert([
			[
				'company_id' => '1',
				'name' => 'GA',
			],
			[
				'company_id' => '2',
				'name' => 'CSC',
			],
			[
				'company_id' => '2',
				'name' => 'navy',
			],
			[
				'company_id' => '3',
				'name' => 'サイトリニューアル',
			],
		]);
	}

}
