<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SneakerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;


Route::get('/', function () {
    return view('welcome');
});

// Connexion
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [UserController::class, 'login'])->name('login.submit');

// Inscription
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [UserController::class, 'store'])->name('register.submit');

// Routes des utilisateurs
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

// Route de déconnexion
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Routes des sneakers
Route::get('/sneakers', [SneakerController::class, 'index'])->name('sneakers.index');
Route::get('/sneakers/{uid}', [SneakerController::class, 'show'])->name('sneakers.show');  // Changement de {id} à {uid}
Route::get('/sneakers/create', [SneakerController::class, 'create'])->name('sneakers.create');
Route::post('/sneakers', [SneakerController::class, 'store'])->name('sneakers.store');
Route::get('/sneakers/{uid}/edit', [SneakerController::class, 'edit'])->name('sneakers.edit');  // Changement de {id} à {uid}
Route::put('/sneakers/{uid}', [SneakerController::class, 'update'])->name('sneakers.update');  // Changement de {id} à {uid}
Route::delete('/sneakers/{uid}', [SneakerController::class, 'destroy'])->name('sneakers.destroy');  // Changement de {id} à {uid}

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});