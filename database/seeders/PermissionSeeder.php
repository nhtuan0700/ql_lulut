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
                'name' => 'goods.manage'
            ],
            [
                'name' => 'registration.manage'
            ],
            [
                'name' => 'stock.manage'
            ],
            [
                'name' => 'family.manage'
            ],
            [
                'name' => 'family.confirm'
            ],
            [
                'name' => 'registration.create'
            ],
        ];
        Permission::insert($data);
    }
}
