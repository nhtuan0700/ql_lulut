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
                    'post.manage',
                    'family.manage'
                ],
            ],
            [
                'role_id' => Role::MANAGER,
                'permissions' => [
                    'registration.manage',
                    'period.manage',
                    'family.confirm',
                    'registation.confirm',
                ],
            ],
            [
                'role_id' => Role::CADRES,
                'permissions' => [
                    'family.registration'
                ],
            ],
            [
                'role_id' => Role::FAMILY,
                'permissions' => [
                    'handover.view'
                ],
            ]
        ];
        foreach ($role_permissions as $item) {
            $permissions = Permission::whereIn('name', $item['permissions'])->select('id')->get();
            Role::find($item['role_id'])->permissions()->sync($permissions);
        }
    }
}
