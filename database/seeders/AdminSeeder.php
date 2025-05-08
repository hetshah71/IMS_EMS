<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        Admin::create([
            'user_id' => $user->id,
            'department' => 'IT',
            'position' => 'Manager',
            'is_super_admin' => true,
        ]);
    }
}
