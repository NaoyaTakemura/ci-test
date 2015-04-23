<?php

use Illuminate\Database\Seeder;

class HolderTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('holders')->truncate();

		DB::table('holders')->insert([
			[
				'company_id' => '1',
				'name' => '竹村',
			],
			[
				'company_id' => '1',
				'name' => '西村さん',
			],
			[
				'company_id' => '1',
				'name' => '杉浦さん',
			],
			[
				'company_id' => '1',
				'name' => '猪股さん',
			],
			[
				'company_id' => '1',
				'name' => '難波さん',
			],
			[
				'company_id' => '1',
				'name' => '東原さん',
			],
			[
				'company_id' => '2',
				'name' => '宮沢さん',
			],
			[
				'company_id' => '2',
				'name' => 'KDDI様',
			],
			[
				'company_id' => '3',
				'name' => 'お茶ゼミ様',
			],
		]);
	}

}
