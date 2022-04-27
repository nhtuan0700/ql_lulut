<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');    
        DB::table('wards')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $data = [
            [
                'name' => 'Xã Hòa Châu'
            ],
            [
                'name' => 'Xã Hòa Tiến'
            ],
            [
                'name' => 'Xã Hòa Phước'
            ],
            [
                'name' => 'Xã Hòa Phong'
            ],
            [
                'name' => 'Xã Hòa Nhơn'
            ],
            [
                'name' => 'Xã Hòa Khương'
            ],
            [
                'name' => 'Xã Hòa Phú'
            ],
            [
                'name' => 'Xã Hòa Sơn'
            ],
            [
                'name' => 'Xã Hòa Ninh'
            ],
            [
                'name' => 'Xã Hòa Liên'
            ],
            [
                'name' => 'Xã Hòa Bắc'
            ],
        ];
        DB::table('wards')->insert($data);
    }
}
