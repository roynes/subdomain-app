<?php

namespace App\Traits;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\Request;

trait RegistersUsers
{
    use RedirectsUsers;

    public function showRegistrationForm($formView)
    {
        return view($formView);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return redirect($this->redirectPath())->with("status", "Client Registration Successful!");
    }

    protected function guard($guard)
    {
        return auth($guard);
    }
}