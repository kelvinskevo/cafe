<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChefController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SpecialController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [ReservationController::class, 'usereservation'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/users', [AdminController::class, 'index'])->name('users.index');
    Route::get('/users/{id}/edit', [AdminController::class, 'edit']);
    Route::put('/users/{id}', [AdminController::class, 'update'])->name('users.update');

    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('users.destroy');


    Route::resource('foods', FoodController::class);


    Route::patch('/reservations/{id}/status', [ReservationController::class, 'updateStatus'])->name('reservations.updateStatus');
    Route::get('/reservations/confirmed', [ReservationController::class, 'confirmed'])->name('reservations.confirmed');
    Route::get('/reservations/rejected', [ReservationController::class, 'rejected'])->name('reservations.rejected');
    Route::get('/reservations/all', [ReservationController::class, 'allreserv'])->name('reservations.all');
    Route::patch('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::patch('/reservations/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');

    Route::get('/specials/this-week', [SpecialController::class, 'thisWeek'])->name('specials.this_week');
    Route::get('/specials/future-weeks', [SpecialController::class, 'futureWeeks'])->name('specials.future_weeks');
    Route::get('/specials/previous-weeks', [SpecialController::class, 'previousWeeks'])->name('specials.previous_weeks');



    Route::resource('reservations', ReservationController::class);
    Route::resource('chefs', ChefController::class);
    Route::resource('specials', SpecialController::class);
    Route::resource('events', EventController::class);
});

require __DIR__ . '/auth.php';



Route::get('/redirects', [HomeController::class, 'redirects']);
