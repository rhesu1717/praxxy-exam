<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function(){
    return view('pages.authentication.login');
});
Route::get('/dashboard', function () {
    return view('pages.dashboard.index');
});
