<?php

namespace Database\Seeders;

use App\Models\Family;
use App\Models\Role;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(1)->create([
            'email' => 'phuc+4@test.com',
            'password' => Hash::make('123123'),
            'role_id' => Role::FAMILY
        ])->each(function ($user) {
            Family::factory()->count(1)->create([
                'owner_name' => 'Trịnh Quang Phúc',
                'ward_id' => 1,
                'user_id' => $user->id
            ]);
            UserInfo::factory()->count(1)->create([
                'user_id' => $user->id,
                'name' => "Trịnh Quang Phúc",
                'ward_id' => 1
            ]);
        });

        User::factory()->count(20)->create([
            'role_id' => Role::FAMILY
        ])->each(function ($user) {
            Family::factory()->count(1)->create([
                'ward_id' => rand(1, 3),
                'user_id' => $user->id
            ])->each(function($family) use ($user) {
                UserInfo::factory()->count(1)->create([
                    'user_id' => $user->id,
                    'ward_id' => $family->ward_id,
                ]);
            });
            
        });
    }
}
