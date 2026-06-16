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
use App\Http\Controllers\TeamController;       // 👈 Ajout
use App\Http\Controllers\UserController;       // 👈 Ajout
use App\Http\Controllers\DashboardController;  // 👈 Ajout

/*
|--------------------------------------------------------------------------
| 🌐 ROUTES PUBLIQUES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/equipes', [TeamController::class, 'index'])->name('teams.index');
Route::get('/equipes/{slug}', [TeamController::class, 'show'])->name('teams.show');

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
| 🔐 ROUTES CONNECTÉES (Tous les utilisateurs inscrits)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // 🔀 Notre Aiguilleur de Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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
    | 🛒 PANIER & COMMANDES
    |--------------------------------------------------------------------------
    */

    Route::prefix('panier')->group(function () {
        Route::get('/', [OrderController::class, 'cart'])->name('cart');
        Route::post('/ajouter', [OrderController::class, 'add'])->name('cart.add');
        Route::post('/remove/{index}', [OrderController::class, 'remove'])->name('cart.remove');
    });

    Route::get('/paiement', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/paiement', [OrderController::class, 'processPayment'])->name('checkout.process');

    Route::get('/mes-commandes', [OrderController::class, 'myOrders'])->name('orders.index');
    Route::get('/mes-commandes/{id}', [OrderController::class, 'show'])->name('orders.show');

    /*
    |--------------------------------------------------------------------------
    | 🎫 LICENCES & BUVETTE
    |--------------------------------------------------------------------------
    */

    Route::get('/mes-licences', [LicenseController::class, 'index'])->name('licenses.index');
    Route::get('/demande-licence', [LicenseController::class, 'create'])->name('licenses.create');
    Route::post('/demande-licence', [LicenseController::class, 'store'])->name('licenses.store');

    Route::get('/buvette', [BuvetteController::class, 'index'])->name('buvette');
});


/*
|--------------------------------------------------------------------------
| ⭐ ESPACE VIP (Réservé aux joueurs licenciés et aux admins)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', App\Http\Middleware\CheckLicencie::class])->group(function () {

    // C'est ici que tu pourras mettre les futures routes protégées
    // Ex: Route::get('/tactiques', [TactiqueController::class, 'index'])->name('tactiques.index');
    // Ex: Route::get('/convocations', [ConvocationController::class, 'index'])->name('convocations.index');

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

        Route::get('/utilisateurs', [UserController::class, 'index'])->name('users.index');
        Route::put('/utilisateurs/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');

        Route::resource('produits', ProductController::class)->except(['show']);

        Route::prefix('commandes')->group(function () {
            Route::get('/', [OrderController::class, 'adminOrders'])->name('orders');
            Route::get('/{id}', [OrderController::class, 'show'])->name('orders.show');
            Route::post('/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
            Route::get('/export', [OrderController::class, 'export'])->name('orders.export');
        });

        Route::prefix('news')->group(function () {
            Route::get('/', [NewsController::class, 'adminIndex'])->name('news.index');
            Route::get('/create', [NewsController::class, 'create'])->name('news.create');
            Route::post('/', [NewsController::class, 'store'])->name('news.store');
            Route::get('/{id}/edit', [NewsController::class, 'edit'])->name('news.edit');
            Route::put('/{id}', [NewsController::class, 'update'])->name('news.update');
            Route::delete('/{id}', [NewsController::class, 'destroy'])->name('news.delete');
        });

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
