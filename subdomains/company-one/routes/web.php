<?php

Route::domain('company-one.sample.test')->group(function() {
    Route::get('/', function() {
        return view('company-one.views.welcome');
    });
});
