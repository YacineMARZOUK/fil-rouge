<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;

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
    return view('welcome');
})->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // Route du profil
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // Routes pour le profil utilisateur
    Route::get('/profile/form', [ProfileController::class, 'form'])->name('profile.form');
    Route::post('/profile/complete', [ProfileController::class, 'complete'])->name('profile.complete');

    // Routes pour les coachs
    Route::middleware(['role:coach'])->prefix('coach')->name('coach.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Coach\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('programs', App\Http\Controllers\Coach\ProgramController::class);
        Route::resource('activities', App\Http\Controllers\Coach\ActivityController::class);
        Route::resource('clients', App\Http\Controllers\Coach\ClientController::class);
    });

    // Routes du panier
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');

    // Routes du checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

    Route::get('/programmes/recommandations', [ProgramController::class, 'recommanderProgrammes'])->name('programs.recommendations');
    Route::post('/programmes/{program}/inscription', [ProgramController::class, 'assignerProgrammeAutomatique'])->name('programs.enroll');
    Route::get('/programs/create', [ProgramController::class, 'create'])->name('programs.create');
});

// Routes de la boutique
Route::get('/boutique', [App\Http\Controllers\Shop\ShopController::class, 'index'])->name('shop');
Route::get('/boutique/{product}', [App\Http\Controllers\Shop\ShopController::class, 'show'])->name('shop.show');
Route::post('/boutique/add-to-cart/{product}', [App\Http\Controllers\Shop\ShopController::class, 'addToCart'])->name('shop.addToCart');

// Route de contact
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Routes pour l'administrateur
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
});
