<?php

use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiProductController;
use App\Http\Controllers\Api\ApiVideoController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::post('/product/upload', [ApiProductController::class, 'upload']);
    Route::delete('/product/destroy/{folder}', [ApiProductController::class, 'imageDelete']);
    Route::resource('product', ApiProductController::class);
    Route::resource('category', ApiCategoryController::class)->only(['index']);
    Route::resource('video', ApiVideoController::class);
});