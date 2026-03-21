<?php

namespace App\Providers;

use App\Models\AboutIntro;
use App\Models\User;
use Illuminate\Support\Facades\View;
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
        View::composer('*', function ($view) {
            $commandUser = User::first(); // atau auth()->user() jika login
            $commandAbout = AboutIntro::latest()->first();

            $view->with(compact('commandUser', 'commandAbout'));
        });
    }
}
