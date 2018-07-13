<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('has_role_of', function($attribute, $value, $parameters, $validator) {
            $user = User::where($attribute, $value)->first();

            if($user->roles->count() == 0) {
                return false;
            }

            return (bool)$user->roles->whereIn('name', $parameters)->count();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
