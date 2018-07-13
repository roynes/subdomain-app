<?php

namespace App\Subdomain\Company\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware([ 'auth:company', 'has_role_of:'.config('roles.admin.client').','.config('roles.client.default') ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Company.views.home');
    }
}
