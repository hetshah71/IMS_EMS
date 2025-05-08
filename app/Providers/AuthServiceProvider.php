<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot()
    {
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            Gate::define($permission->name, function (User $user) use ($permission) {
                // Super admin has access to all permissions
                if ($user->isSuperAdmin()) {
                    return true;
                }
                return $user->hasPermission($permission->name);
            });
        }
    }
}
