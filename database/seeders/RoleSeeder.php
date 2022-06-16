<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Quản trị viên'
            ],
            [
                'id' => 2,
                'name' => 'Cán bộ quản lý phân phối'
            ],
            [
                'id' => 3,
                'name' => 'Cán bộ phường'
            ],
            [
                'id' => 4,
                'name' => 'Người ủng hộ'
            ],
            [
                'id' => 5,
                'name' => 'Chủ hộ gia đình'
            ]
        ];
        Role::insert($data);
    }
}
