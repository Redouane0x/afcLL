<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BuvetteController;

/*
|--------------------------------------------------------------------------
| 🌐 ROUTES PUBLIQUES
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
| 🔐 ROUTES AUTH
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/redirect', function () {
        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.products')
            : redirect()->route('dashboard');
    })->name('login.redirect');

    Route::get('/dashboard', function () {
        return view('pages.user.dashboard');
    })->name('dashboard');

    // Boutique
    Route::get('/boutique/{id}', [ProductController::class, 'show'])->name('shop.show');

    // Panier
    Route::get('/panier', [OrderController::class, 'cart'])->name('cart');
    Route::post('/panier/ajouter', [OrderController::class, 'add'])->name('cart.add');
    Route::post('/panier/remove/{index}', [OrderController::class, 'remove'])->name('cart.remove');

    // Paiement
    Route::get('/paiement', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/paiement', [OrderController::class, 'processPayment'])->name('checkout.process');

    // Commandes
    Route::get('/mes-commandes', [OrderController::class, 'myOrders'])->name('orders.index');
    Route::get('/mes-commandes/{id}', [OrderController::class, 'show'])->name('orders.show');

    // Licences
    Route::get('/mes-licences', [LicenseController::class, 'myLicenses'])->name('licenses.index');
    Route::post('/licences/demande', [LicenseController::class, 'store'])->name('licenses.store');

    // Buvette
    Route::get('/buvette', [BuvetteController::class, 'index'])->name('buvette');

    Route::view('/planning', 'pages.joueur.planning')->name('joueur.planning');
    Route::view('/paiement-joueur', 'pages.joueur.paiement')->name('joueur.paiement');
});

/*
|--------------------------------------------------------------------------
| 🛠️ ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth']) // 👉 tu peux ajouter 'admin' ici si tu veux sécuriser
->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // ✅ FIX ICI (products au lieu de produits)
        Route::resource('products', ProductController::class)
            ->names([
                'index' => 'products',
                'create' => 'products.create',
                'store' => 'products.store',
                'edit' => 'products.edit',
                'update' => 'products.update',
                'destroy' => 'products.delete',
            ])
            ->except(['show']);

        // Commandes
        Route::get('/commandes', [OrderController::class, 'adminOrders'])->name('orders');
        Route::post('/commandes/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.status');

        // Buvette
        Route::get('/buvette', [BuvetteController::class, 'adminIndex'])->name('buvette');
        Route::get('/buvette/create', [BuvetteController::class, 'create'])->name('buvette.create');
        Route::post('/buvette', [BuvetteController::class, 'store'])->name('buvette.store');
        Route::delete('/buvette/{id}', [BuvetteController::class, 'destroy'])->name('buvette.delete');
    });

/*
|--------------------------------------------------------------------------
| 🔐 AUTH
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
