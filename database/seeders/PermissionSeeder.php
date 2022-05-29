<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
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
                'name' => 'user.manage'
            ],
            [
                'name' => 'post.manage'
            ],
            [
                'name' => 'goods.manage'
            ],
            [
                'name' => 'period.manage'
            ],
            [
                'name' => 'registration.manage'
            ],
            [
                'name' => 'family.manage'
            ],
            [
                'name' => 'family.registration'
            ]
        ];
        Permission::insert($data);
    }
}
