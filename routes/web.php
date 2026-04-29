<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BuvetteController;

/*
|--------------------------------------------------------------------------
| 🌐 ROUTES PUBLIQUES (Accessibles à tous)
|--------------------------------------------------------------------------
*/

Route::view('/', 'pages.public.home')->name('home');
Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda');
Route::get('/boutique', [ProductController::class, 'index'])->name('boutique');

Route::view('/club', 'pages.public.club')->name('club');
Route::view('/actualites', 'pages.public.actualites')->name('actualites');
Route::view('/galerie', 'pages.public.galerie')->name('galerie');
Route::view('/contact', 'pages.public.contact')->name('contact');

/*
|--------------------------------------------------------------------------
| 🔐 ROUTES AUTHENTIFIÉES (Utilisateurs connectés)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // Redirection intelligente après login
    Route::get('/redirect', function () {
        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.products')
            : redirect()->route('dashboard');
    })->name('login.redirect');

    // Dashboard
    Route::get('/dashboard', function () {
        return view('pages.user.dashboard');
    })->name('dashboard');

    /* --- 🛒 BOUTIQUE & PANIER --- */
    Route::get('/boutique/{id}', [ProductController::class, 'show'])->name('shop.show');
    Route::get('/panier', [OrderController::class, 'cart'])->name('cart');
    Route::post('/panier/ajouter', [OrderController::class, 'add'])->name('cart.add');
    Route::post('/panier/remove/{index}', [OrderController::class, 'remove'])->name('cart.remove');

    /* --- 💳 PAIEMENT & COMMANDES --- */
    Route::get('/paiement', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/paiement', [OrderController::class, 'processPayment'])->name('checkout.process');
    Route::get('/mes-commandes', [OrderController::class, 'myOrders'])->name('orders.index');
    Route::get('/mes-commandes/{id}', [OrderController::class, 'show'])->name('orders.show');

    /* --- 🎫 LICENCES --- */
    Route::get('/mes-licences', [LicenseController::class, 'myLicenses'])->name('licenses.index');
    Route::post('/licences/demande', [LicenseController::class, 'store'])->name('licenses.store');

    /* --- 👤 ESPACE JOUEUR & BUVETTE --- */
    Route::get('/buvette', [BuvetteController::class, 'index'])->name('buvette');
    Route::view('/planning', 'pages.joueur.planning')->name('joueur.planning');
    Route::view('/paiement-joueur', 'pages.joueur.paiement')->name('joueur.paiement');
});

/*
|--------------------------------------------------------------------------
| 🛠️ ROUTES ADMINISTRATION (Accès restreint)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Gestion des produits
    Route::resource('produits', ProductController::class)->except(['show']);
    // Note: resource remplace index, create, store, edit, update, destroy d'un coup !
    Route::resource('produits', ProductController::class)
        ->names(['index' => 'products'])
        ->except(['show']);
    // Gestion des commandes
    Route::get('/commandes', [OrderController::class, 'adminOrders'])->name('orders');
    Route::post('/commandes/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.status');

    // Gestion de la buvette
    Route::get('/buvette', [BuvetteController::class, 'adminIndex'])->name('buvette');
    Route::get('/buvette/create', [BuvetteController::class, 'create'])->name('buvette.create');
    Route::post('/buvette', [BuvetteController::class, 'store'])->name('buvette.store');
    Route::delete('/buvette/{id}', [BuvetteController::class, 'destroy'])->name('buvette.delete');
});

/*
|--------------------------------------------------------------------------
| 🔐 AUTH (Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
