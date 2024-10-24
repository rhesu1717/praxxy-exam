<?php

use App\Http\Controllers\Authentication\AuthenticationController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest'])->group(function () {
    Route::get('/', function(){
        return view('pages.authentication.login');
    });

    Route::post('/authenticate', [AuthenticationController::class, 'login'])->name('authentication.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard.index');
    })->name('dashboard');

    Route::get('/logout', [AuthenticationController::class, 'logout']);
});
