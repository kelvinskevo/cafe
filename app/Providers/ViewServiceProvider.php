<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;


class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $titles = [
            'reservations.index' => 'Reservations',
            'reservations.confirmed' => 'Confirmed Reservations',
            'reservations.rejected' => 'Rejected Reservations',
            'reservations.all' => 'All Reservations',
            'chefs.index' => 'Chefs',
            'chefs.create' => 'New Chef',
            'chefs.edit' => 'Edit Chef',
            'events.index' => 'Events',
            'events.create' => 'New Event',
            'events.edit' => 'Edit Event',
            'foods.index' => 'Foods',
            'foods.create' => 'New Food',
            'foods.edit' => 'Edit Food',
            'specials.index' => 'Specials',
            'specials.create' => 'New Special',
            'specials.edit' => 'Edit Special',
            'users.index' => 'Users',
            'users.create' => 'New User',
            'users.edit' => 'Edit User',
            // Add more mappings here
        ];

        View::composer('*', function ($view) use ($titles) {
            $routeName = Route::currentRouteName();
            $title = $titles[$routeName] ?? ucfirst(str_replace('.', ' ', $routeName)); // Default to route name if not mapped

            $view->with('pageTitle', $title);
        });
    }
}
