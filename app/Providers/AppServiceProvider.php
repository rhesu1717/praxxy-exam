<?php

namespace App\Providers;

use App\Interfaces\CategoryInterface;
use App\Interfaces\ImageUploadInterface;
use App\Interfaces\ProductInterface;
use App\Services\CategoryService;
use App\Services\ImageUploadService;
use App\Services\ProductService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductInterface::class, ProductService::class);
        $this->app->bind(CategoryInterface::class, CategoryService::class);
        $this->app->bind(ImageUploadInterface::class, ImageUploadService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
