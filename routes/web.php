<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\OrderController;

// 🟢 1. TES ROUTES PUBLIQUES (Statiques)
Route::view('/', 'pages.home');
Route::view('/agenda', 'pages.agenda');
Route::view('/club', 'pages.club');
Route::view('/actualites', 'pages.actualites');
Route::view('/galerie', 'pages.galerie');
Route::view('/contact', 'pages.contact');

// 🔵 2. TA BOUTIQUE (Dynamique : va chercher les produits en base)
Route::get('/boutique', [ProductController::class, 'index'])->name('boutique');

// 🔴 3. L'ESPACE ADHÉRENT (Protégé par la connexion)
Route::middleware(['auth', 'verified'])->group(function () {

    // Le tableau de bord après connexion
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Licences
    Route::get('/mes-licences', [LicenseController::class, 'myLicenses'])->name('licenses.index');
    Route::post('/licences/demande', [LicenseController::class, 'store'])->name('licenses.store');

    // Commandes
    Route::get('/mes-commandes', [OrderController::class, 'myOrders'])->name('orders.index');
    Route::post('/commander', [OrderController::class, 'store'])->name('orders.store');
});

// 🟠 4. LES ROUTES D'AUTHENTIFICATION DE BREEZE (Login, Register...)
require __DIR__.'/auth.php';
