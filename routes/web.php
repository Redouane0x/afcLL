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
use App\Http\Controllers\UserController; // 👈 AJOUT ICI

/*
|--------------------------------------------------------------------------
| 🌐 ROUTES PUBLIQUES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda');

// 🛍️ SHOP
Route::get('/boutique', [ProductController::class, 'index'])->name('shop.index');
Route::get('/boutique/{id}', [ProductController::class, 'show'])->name('shop.show');

// 📰 ACTUALITÉS
Route::get('/actualites', [NewsController::class, 'index'])->name('news.index');

// 📄 PAGES
Route::view('/club', 'pages.public.club')->name('club');
Route::view('/contact', 'pages.public.contact')->name('contact');


/*
|--------------------------------------------------------------------------
| 🔐 ROUTES CONNECTÉES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', fn () => view('pages.user.dashboard'))->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | 📸 GALERIE
    |--------------------------------------------------------------------------
    */

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

    Route::delete('/comment/{id}', [GalleryController::class, 'deleteComment'])->name('comment.delete');


    /*
    |--------------------------------------------------------------------------
    | 📰 ACTUALITÉS (USER)
    |--------------------------------------------------------------------------
    */

    Route::post('/news/{id}/comment', [NewsController::class, 'comment'])->name('news.comment');
    Route::post('/news/{id}/like', [NewsController::class, 'like'])->name('news.like');


    /*
    |--------------------------------------------------------------------------
    | 🛒 PANIER
    |--------------------------------------------------------------------------
    */

    Route::prefix('panier')->group(function () {

        Route::get('/', [OrderController::class, 'cart'])->name('cart');
        Route::post('/ajouter', [OrderController::class, 'add'])->name('cart.add');
        Route::post('/remove/{index}', [OrderController::class, 'remove'])->name('cart.remove');

    });


    /*
    |--------------------------------------------------------------------------
    | 💳 COMMANDES (USER)
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

Route::middleware(['auth', App\Http\Middleware\CheckAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | 👥 UTILISATEURS (AJOUT)
        |--------------------------------------------------------------------------
        */

        Route::get('/utilisateurs', [UserController::class, 'index'])->name('users.index');
        Route::put('/utilisateurs/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');

        /*
        |--------------------------------------------------------------------------
        | 🛍️ PRODUITS
        |--------------------------------------------------------------------------
        */

        Route::resource('produits', ProductController::class)->except(['show']);

        /*
        |--------------------------------------------------------------------------
        | 📦 COMMANDES (ADMIN)
        |--------------------------------------------------------------------------
        */

        Route::prefix('commandes')->group(function () {

            Route::get('/', [OrderController::class, 'adminOrders'])->name('orders');

            // 🔥 LA ROUTE QUI MANQUAIT (VERY IMPORTANT)
            Route::get('/{id}', [OrderController::class, 'show'])
                ->name('orders.show');

            Route::post('/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.status');

            Route::get('/export', [OrderController::class, 'export'])->name('orders.export');

        });

        /*
        |--------------------------------------------------------------------------
        | 📰 ACTUALITÉS (ADMIN)
        |--------------------------------------------------------------------------
        */

        Route::prefix('news')->group(function () {

            Route::get('/', [NewsController::class, 'adminIndex'])->name('news.index');
            Route::get('/create', [NewsController::class, 'create'])->name('news.create');
            Route::post('/', [NewsController::class, 'store'])->name('news.store');

            Route::get('/{id}/edit', [NewsController::class, 'edit'])->name('news.edit');
            Route::put('/{id}', [NewsController::class, 'update'])->name('news.update');
            Route::delete('/{id}', [NewsController::class, 'destroy'])->name('news.delete');

        });

        /*
        |--------------------------------------------------------------------------
        | 🥤 BUVETTE
        |--------------------------------------------------------------------------
        */

        Route::prefix('buvette')->group(function () {

            Route::get('/', [BuvetteController::class, 'adminIndex'])->name('buvette');
            Route::get('/create', [BuvetteController::class, 'create'])->name('buvette.create');
            Route::post('/', [BuvetteController::class, 'store'])->name('buvette.store');
            Route::delete('/{id}', [BuvetteController::class, 'destroy'])->name('buvette.delete');

        });

    });


/*
|--------------------------------------------------------------------------
| 🔐 AUTH
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
