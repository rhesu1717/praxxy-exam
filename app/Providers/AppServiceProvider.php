<?php

namespace App\Providers;

use App\Interfaces\CategoryInterface;
use App\Interfaces\ImageUploadInterface;
use App\Interfaces\ProductInterface;
use App\Interfaces\VideoInterface;
use App\Services\CategoryService;
use App\Services\ImageUploadService;
use App\Services\ProductService;
use App\Services\VideoService;
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
        $this->app->bind(VideoInterface::class, VideoService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
