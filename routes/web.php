<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BuvetteController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TeamController;

/*
|--------------------------------------------------------------------------
| 🌐 ROUTES PUBLIQUES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/equipes', [TeamController::class, 'index'])->name('teams.index');
Route::get('/equipes/{slug}', [TeamController::class, 'show'])->name('teams.show');

Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda');

Route::get('/boutique', [ProductController::class, 'index'])->name('shop.index');
Route::get('/boutique/{id}', [ProductController::class, 'show'])->name('shop.show');

Route::get('/actualites', [NewsController::class, 'index'])->name('news.index');

Route::view('/club', 'pages.public.club')->name('club');
Route::view('/contact', 'pages.public.contact')->name('contact');


/*
|--------------------------------------------------------------------------
| 🔐 ROUTES CONNECTÉES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', fn () => view('pages.user.dashboard'))->name('dashboard');

    Route::prefix('galerie')->group(function () {
        Route::get('/', [GalleryController::class, 'index'])->name('gallery');
        Route::get('/create', [GalleryController::class, 'create'])->name('gallery.create');
        Route::post('/', [GalleryController::class, 'store'])->name('gallery.store');
        Route::get('/{id}/edit', [GalleryController::class, 'edit'])->name('gallery.edit');
        Route::put('/{id}', [GalleryController::class, 'update'])->name('gallery.update');
        Route::post('/{id}/like', [GalleryController::class, 'like'])->name('gallery.like');
        Route::post('/{id}/comment', [GalleryController::class, 'comment'])->name('gallery.comment');
        Route::delete('/{id}', [GalleryController::class, 'destroy'])->name('gallery.delete');
    });

    Route::post('/news/{id}/comment', [NewsController::class, 'comment'])->name('news.comment');
    Route::post('/news/{id}/like', [NewsController::class, 'like'])->name('news.like');

    Route::prefix('panier')->group(function () {
        Route::get('/', [OrderController::class, 'cart'])->name('cart');
        Route::post('/ajouter', [OrderController::class, 'add'])->name('cart.add');
        Route::post('/remove/{index}', [OrderController::class, 'remove'])->name('cart.remove');
    });

    Route::get('/paiement', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/paiement', [OrderController::class, 'processPayment'])->name('checkout.process');

    Route::get('/mes-commandes', [OrderController::class, 'myOrders'])->name('orders.index');
    Route::get('/mes-commandes/{id}', [OrderController::class, 'show'])->name('orders.show');

    Route::get('/buvette', [BuvetteController::class, 'index'])->name('buvette');
});

/*
|--------------------------------------------------------------------------
| 🛠️ ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('produits', ProductController::class)->except(['show']);

        Route::prefix('commandes')->group(function () {
            Route::get('/', [OrderController::class, 'adminOrders'])->name('orders');
            Route::get('/{id}', [OrderController::class, 'show'])->name('orders.show');
            Route::post('/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
            Route::get('/export', [OrderController::class, 'export'])->name('orders.export');
        });

        Route::prefix('news')->group(function () {
            Route::get('/', [NewsController::class, 'adminIndex'])->name('news.index');
        });

    });

require __DIR__.'/auth.php';
