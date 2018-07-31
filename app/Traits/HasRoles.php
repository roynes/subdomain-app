<?php

namespace App\Traits;

use App\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

trait HasRoles
{

    /**
     * Fetches Roles related to User
     *
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Assigns a Role to a given User
     *
     * @param Role $role
     * @return mixed
     */
    public function assignRole(Role $role)
    {
        return $this->roles()->save($role);
    }

    /**
     * @param string|array|Collection $role
     *
     * @return bool
     */
    public function hasRole($role = '')
    {
        if (method_exists($this, 'emailRoles')) {
            return $this->emailRoles();
        }

        if(property_exists($this, 'emailRole') )
        {
            return $this->emailRole ?? config('client.default');
        }

        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return (bool) $role->intersect($this->roles)->count();
    }

    /**
     * Fetches the User's roles
     *
     * @param $roles
     * @return bool
     */
    public function hasRoles(array $roles)
    {
        if($this->roles->count() == 0)
        {
            return false;
        }

        return (bool) $this->roles->whereIn('name', $roles)->count();
    }

    //------------------------- User Roles

    public function isSuperAdmin()
    {
        return $this->hasRole(config('admin.super'));
    }

    public function isGroupAdmin()
    {
        return $this->hasRole(config('admin.group'));
    }

    public function isClientAdmin()
    {
        return $this->hasRole(config('admin.client'));
    }

    public function isGroupClient()
    {
        return $this->hasRole(config('client.group'));
    }

    public function isNormalClient()
    {
        return $this->hasRole(config('client.default'));
    }
}