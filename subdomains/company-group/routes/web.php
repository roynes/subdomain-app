<?php

Route::domain('company-group.sample.test')->group(function() {
    Route::get('/', function() {
        return view('company-group.views.welcome');
    })->name('company.group.index');
});
