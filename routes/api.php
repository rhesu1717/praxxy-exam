<?php

use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('product', ApiProductController::class);
    Route::resource('category', ApiCategoryController::class)->only(['index']);
});