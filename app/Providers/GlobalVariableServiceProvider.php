<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\user;
use Illuminate\View\View;


class GlobalVariableServiceProvider extends ServiceProvider
{
    public function register()
    {
        view()->composer('layouts.master', function (View $view) {
            // Retrieve the selected patient data using the helper function
            $selectedPatient = getSelectedPatient();

            // Pass the selected patient's data to the 'master' view
            $view->with('selectedPatient', $selectedPatient);
        });
    }
}
