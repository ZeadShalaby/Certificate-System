<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Groups;
use App\Models\Courses;
use App\Models\Certificates;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

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
        //?s use in media morph
        Relation::enforceMorphMap([
            'User' => User::class,
            'Certificate' => Certificates::class,
        ]);
    }
}
