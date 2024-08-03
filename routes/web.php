<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoodController;
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

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/users', [AdminController::class, 'index'])->name('users.index');
    Route::get('/users/{id}/edit', [AdminController::class, 'edit']);
    Route::put('/users/{id}', [AdminController::class, 'update'])->name('users.update');

    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('users.destroy');


    Route::resource('foods', FoodController::class);
});

require __DIR__ . '/auth.php';

Route::get('/home', [HomeController::class, 'index']);

Route::get('/redirects', [HomeController::class, 'redirects']);
