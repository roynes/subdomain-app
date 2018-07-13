<?php

namespace App\Subdomain\Company\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use ThrottlesLogins, RedirectsUsers;

    protected $guard;
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    public function __construct()
    {
        $this->middleware('guest:company')->except('logout');
        $this->guard = auth('company');
    }

    public function showLoginForm()
    {
        return view('Company.views.auth.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateCredentials($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if($this->guard->attempt($request->only(['email', 'password'])))
        {
            $user = $this->guard->user();

            if(! $user->hasRoles([config('roles.admin.client'), config('roles.client.default')])) {
                $this->guard->logout();

                return redirect()->back()->with('status', 'Access Denied');
            }

            return redirect()->intended($this->redirectPath());
        }

        return redirect()->back()->withInput(['email', 'remember']);
    }

    protected function validateCredentials($request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users',
            'password' => 'required|string'
        ]);
    }

    public function logout()
    {
        $this->guard->logout();

        return redirect(route('company.welcome'));
    }

    public function redirectTo()
    {
        return route('company.home');
    }
}