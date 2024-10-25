<?php

use App\Http\Controllers\Api\ApiProductController;
use Illuminate\Support\Facades\Route;


Route::resource('product', ApiProductController::class);