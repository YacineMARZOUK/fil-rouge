<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CoachController;

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
})->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // Routes pour les coachs
    Route::prefix('coach')->name('coach.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Coach\DashboardController::class, 'index'])->name('dashboard');
        
        // Routes pour les programmes
        Route::resource('programs', App\Http\Controllers\Coach\ProgramController::class);
        
        // Routes pour les activités
        Route::resource('activities', App\Http\Controllers\Coach\ActivityController::class);
        
        // Routes pour les objectifs utilisateur
        Route::resource('user-goals', App\Http\Controllers\Coach\UserGoalController::class);
    });
});

// Routes de la boutique
Route::get('/boutique', [App\Http\Controllers\ShopController::class, 'index'])->name('shop.index');
Route::get('/boutique/{product}', [App\Http\Controllers\ShopController::class, 'show'])->name('shop.show');
