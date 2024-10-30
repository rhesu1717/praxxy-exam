<?php

use App\Http\Controllers\Authentication\AuthenticationController;
use App\Http\Controllers\Product\ProductController;
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

    // Route::group(['prefix' => 'product', 'controller' => ProductController::class], function(){
    //     Route::get('/', 'index')->name('product.list');
    // });
    Route::get('/logout', [AuthenticationController::class, 'logout']);

    Route::get('/{any}', function () {
        return view('pages.dashboard.index');
    })->where('any', '.*');

});
