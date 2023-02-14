<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $categories = Category::query()->pluck('title', 'slug');
        View::composer('layouts.header', function ($view) use ($categories) {
            $view->with('categories', $categories);
        });
        View::composer('layouts.footer', function ($view) use ($categories) {
            $view->with('categories', $categories);
        });
    }
}
