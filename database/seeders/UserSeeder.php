<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'email' => 'admin@test.com',
                'password' => Hash::make('123123'),
                'role_id' => Role::ADMIN
            ],
            [
                'email' => 'phuc@test.com',
                'password' => Hash::make('123123'),
                'role_id' => Role::SUPPORTER
            ]
        ];
        
        foreach ($data as $item) {
            $user = User::create($item);
            UserInfo::create([
                'user_id' => $user->id,
                'name' => 'Trịnh Quang Phúc'
            ]);
        }

        User::factory()->count(20)->create()->each(function($user) {
            UserInfo::factory()->count(1)->create([
                'user_id' => $user->id
            ]);
        });
    }
}
