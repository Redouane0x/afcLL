<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BuvetteController;
use App\Http\Controllers\GalleryController;

/*
|--------------------------------------------------------------------------
| 🌐 ROUTES PUBLIQUES
|--------------------------------------------------------------------------
*/

Route::view('/', 'pages.public.home')->name('home');
Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda');

Route::get('/boutique', [ProductController::class, 'index'])->name('shop.index');

Route::view('/club', 'pages.public.club')->name('club');
Route::view('/actualites', 'pages.public.actualites')->name('actualites');
Route::view('/contact', 'pages.public.contact')->name('contact');

/*
|--------------------------------------------------------------------------
| 🔐 ROUTES CONNECTÉES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('pages.user.dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | 📸 GALERIE (TOUT ICI 🔥)
    |--------------------------------------------------------------------------
    */

    Route::get('/galerie', [GalleryController::class, 'index'])->name('gallery');

    Route::get('/galerie/create', [GalleryController::class, 'create'])->name('gallery.create');
    Route::post('/galerie', [GalleryController::class, 'store'])->name('gallery.store');

    Route::get('/galerie/{id}/edit', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::put('/galerie/{id}', [GalleryController::class, 'update'])->name('gallery.update');

    Route::post('/galerie/{id}/like', [GalleryController::class, 'like'])->name('gallery.like');
    Route::post('/galerie/{id}/comment', [GalleryController::class, 'comment'])->name('gallery.comment');

    Route::delete('/galerie/{id}', [GalleryController::class, 'destroy'])->name('gallery.delete');
    Route::delete('/comment/{id}', [GalleryController::class, 'deleteComment'])->name('comment.delete');

    /*
    |--------------------------------------------------------------------------
    | 🛒 SHOP
    |--------------------------------------------------------------------------
    */

    Route::get('/boutique/{id}', [ProductController::class, 'show'])->name('shop.show');

    Route::get('/panier', [OrderController::class, 'cart'])->name('cart');
    Route::post('/panier/ajouter', [OrderController::class, 'add'])->name('cart.add');
    Route::post('/panier/remove/{index}', [OrderController::class, 'remove'])->name('cart.remove');

    /*
    |--------------------------------------------------------------------------
    | 💳 COMMANDES
    |--------------------------------------------------------------------------
    */

    Route::get('/paiement', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/paiement', [OrderController::class, 'processPayment'])->name('checkout.process');

    Route::get('/mes-commandes', [OrderController::class, 'myOrders'])->name('orders.index');
    Route::get('/mes-commandes/{id}', [OrderController::class, 'show'])->name('orders.show');

    /*
    |--------------------------------------------------------------------------
    | 🎫 LICENCES
    |--------------------------------------------------------------------------
    */

    Route::get('/mes-licences', [LicenseController::class, 'myLicenses'])->name('licenses.index');
    Route::post('/licences/demande', [LicenseController::class, 'store'])->name('licenses.store');

    /*
    |--------------------------------------------------------------------------
    | 🥤 BUVETTE
    |--------------------------------------------------------------------------
    */

    Route::get('/buvette', [BuvetteController::class, 'index'])->name('buvette');
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

    Route::resource('produits', ProductController::class)
        ->names(['index' => 'products'])
        ->except(['show']);

    Route::get('/commandes', [OrderController::class, 'adminOrders'])->name('orders');
    Route::post('/commandes/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.status');

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
