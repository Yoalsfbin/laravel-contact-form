<?php

namespace App\Providers;

use App\Http\Middleware\AdminMiddleware;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 管理者権限のミドルウェア設定
        Route::aliasMiddleware('admin', AdminMiddleware::class);
    }
}
