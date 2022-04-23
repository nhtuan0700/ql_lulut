<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role_permissions = [
            [
                'role_id' => Role::ADMIN,
                'permissions' => [
                    'user.manage',
                    'goods.manage',
                    'registration.manage',
                    'family.confirm'
                ],
            ],
            [
                'role_id' => Role::STAFF,
                'permissions' => [
                    'stock.manage'
                ],
            ],
            [
                'role_id' => Role::CADRES,
                'permissions' => [
                    'family.manage'
                ],
            ],
            [
                'role_id' => Role::SUPPORTER,
                'permissions' => [
                    'registration.create',
                ],
            ],
        ];
        foreach ($role_permissions as $item) {
            $permission = Permission::whereIn('name', $item['permissions'])->select('id')->get();
            Role::find(1)->permissions()->sync($permission);
        }
    }
}
