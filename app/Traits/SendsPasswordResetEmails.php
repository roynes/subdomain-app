<?php

namespace App\Traits;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails as BaseTrait;
use Illuminate\Http\Request;


trait SendsPasswordResetEmails
{
    use BaseTrait, HasRoles;

    /**
     * Validate the email for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateEmail(Request $request)
    {
        $this->validate($request, [ 'email' => 'required|email|has_role_of:'.$this->hasRole() ]);
    }
}