<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\CommentRepository;
use App\Repositories\RepliesRepository;

class AppServiceProvider extends ServiceProvider
{
    
    public function register()
    {
        // $this->app->bind(CommentRepository::class);
        // $this->app->bind(RepliesRepository::class);
    }

    public function boot()
    {
        //
    }
}
