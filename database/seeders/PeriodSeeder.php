<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');    
        DB::table('periods')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $data = [
            [
                'id' => '220201',
                'ward_id' => 3,
                'name' => 'Quyên góp hỗ trợ tháng 2',
                'date_end' => '2022-03-15',
            ],
            [
                'id' => '220501',
                'ward_id' => 1,
                'name' => 'Quyên góp hỗ trợ bà con nghèo tháng 5',
                'date_end' => '2022-06-30',
            ]
        ];
        DB::table('periods')->insert($data);
    }
}
