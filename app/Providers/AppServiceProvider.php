<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\CommentRepository;
use App\Repositories\RepliesRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind(CommentRepository::class);
        // $this->app->bind(RepliesRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
