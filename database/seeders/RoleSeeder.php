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
                'name' => 'Nhân viên kho'
            ],
            [
                'id' => 3,
                'name' => 'Cán bộ phường'
            ],
            [
                'id' => 4,
                'name' => 'Người ủng hộ'
            ]
        ];
        Role::insert($data);
    }
}
