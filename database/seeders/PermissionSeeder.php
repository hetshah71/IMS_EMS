<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            ['name' => 'manage-tasks', 'slug' => 'manage-tasks'],
            ['name' => 'manage-interns', 'slug' => 'manage-interns'],
            ['name' => 'manage-admins', 'slug' => 'manage-admins'],
            ['name' => 'manage-roles', 'slug' => 'manage-roles'],
            ['name' => 'manage-permissions', 'slug' => 'manage-permissions'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
