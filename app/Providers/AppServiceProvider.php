<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
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
            $view->with(['categories' => $categories]);
        });
        View::composer('layouts.footer', function ($view) use ($categories) {
            $popular_news = Post::query()
                ->with('category')
                ->orderBy('views', 'desc')
                ->limit(3)
                ->get();
            $view->with([
                'categories' => $categories,
                'popular_news' => $popular_news
            ]);
        });
    }
}
