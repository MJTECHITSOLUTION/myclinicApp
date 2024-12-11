<?php

namespace App\Providers;

use App\Patient;
use App\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
            Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $lastChosenUserId = session('last_chosen_user_id');

// Query the User model to get the last chosen user
        $lastChosenUser = User::find($lastChosenUserId);

// If the last chosen user is not found, you can set a default value (e.g., null) or handle it according to your requirements
        if (!$lastChosenUser) {
            $lastChosenUser = null;
        }

// Share the last chosen user with the view
        view()->share('patient_val', $lastChosenUser);
        Paginator::useBootstrap();

    }
}
