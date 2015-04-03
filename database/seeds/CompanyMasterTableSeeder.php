<?php

use Illuminate\Database\Seeder;

class CompanyMasterTableSeeder extends Seeder
{
  
    public function run()
    {
        DB::table('company_masters')->truncate();
  
        DB::table('company_masters')->insert([
            [
                'name'      => 'ユヒーロ',
            ],
            [
                'name'      => 'NGC',
            ],
            [
                'name'      => 'お茶ゼミ',
            ],
        ]);
  
    }	
  
}