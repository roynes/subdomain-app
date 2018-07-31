<?php

namespace App\Http\Providers;

use App\Permission;
use App\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class RolesAndPermissionsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        try {
            foreach($this->getPermissions() as $permission) {
                Gate::define($permission->name, function($user) use ($permission) {
                    return $user->hasRole($permission->roles);
                });
            }
        } catch (\Exception $e) {
            return;
        }

    }

    protected function getPermissions()
    {
        return Permission::with('roles')->get();
    }
}