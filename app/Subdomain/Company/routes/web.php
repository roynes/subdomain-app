<?php

Route::domain('company-one.sample.test')->group(function() {
    Route::get('/login', 'LoginController@showLoginForm')->name('company.login');
    Route::post('/login', 'LoginController@login')->name('company.login.submit');
    Route::post('/logout', 'LoginController@logout')->name('company.logout');

    Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('company.password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('company.password.email');

    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('company.password.reset');
    Route::post('/password/reset', 'ResetPasswordController@reset');

    Route::get('/home', 'HomeController@index')->name('company.home');

    Route::get('/register', 'RegisterController@showRegisterForm')->name('company.user.register');
    Route::post('/register', 'RegisterController@register')->name('company.user.register.submit');

    Route::get('/', function() {
        return view('Company.views.welcome');
    })->name('company.welcome');
});
