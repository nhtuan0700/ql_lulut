<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');    
        DB::table('goods')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $data = [
            [
                'name' => 'Mỳ tôm',
                'qty' => 10,
                'unit' => 'Thùng'
            ],
            [
                'name' => 'Áo phao',
                'qty' => 10,
                'unit' => 'Cái'
            ],
            [
                'name' => 'Nước suối',
                'qty' => 20,
                'unit' => 'Thùng'
            ]
        ];

        DB::table('goods')->insert($data);
    }
}
