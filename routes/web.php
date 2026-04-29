<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\OrderController;
<<<<<<< HEAD
use App\Http\Controllers\AgendaController;
=======
use App\Http\Controllers\BuvetteController;
>>>>>>> 5b8a630ec72cdb1c5560a1d7375619c6e0212b83

/*
|--------------------------------------------------------------------------
| 🌐 ROUTES PUBLIQUES
|--------------------------------------------------------------------------
*/

<<<<<<< HEAD
Route::get('/boutique', [ProductController::class, 'index'])->name('boutique');
Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda');
=======
Route::view('/', 'pages.public.home')->name('home');
Route::view('/agenda', 'pages.public.agenda')->name('agenda');
Route::view('/club', 'pages.public.club')->name('club');
Route::view('/actualites', 'pages.public.actualites')->name('actualites');
Route::view('/galerie', 'pages.public.galerie')->name('galerie');
Route::view('/contact', 'pages.public.contact')->name('contact');
Route::view('/buvette', 'pages.public.buvette')->name('buvette');


/*
|--------------------------------------------------------------------------
| 🔁 REDIRECTION LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/redirect', function () {
    $user = auth()->user();

    return $user->role === 'admin'
        ? redirect()->route('admin.products')
        : redirect()->route('dashboard');

})->middleware('auth');


/*
|--------------------------------------------------------------------------
| 🔐 ROUTES UTILISATEUR CONNECTÉ
|--------------------------------------------------------------------------
*/

>>>>>>> 5b8a630ec72cdb1c5560a1d7375619c6e0212b83
Route::middleware(['auth', 'verified'])->group(function () {

    /*
    | 📊 Dashboard
    */
    Route::get('/dashboard', function () {
        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.products')
            : view('pages.user.dashboard');
    })->name('dashboard');


    /*
    | 🛍️ BOUTIQUE
    */
    Route::get('/boutique', [ProductController::class, 'index'])->name('shop.index');
    Route::get('/boutique/{id}', [ProductController::class, 'show'])->name('shop.show');


    /*
    | 🛒 PANIER
    */
    Route::get('/panier', [OrderController::class, 'cart'])->name('cart');
    Route::post('/panier/ajouter', [OrderController::class, 'add'])->name('cart.add');
    Route::post('/panier/remove/{index}', [OrderController::class, 'remove'])->name('cart.remove');


    /*
    | 💳 PAIEMENT
    */
    Route::get('/paiement', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/paiement', [OrderController::class, 'processPayment'])->name('checkout.process');


    /*
    | 📦 COMMANDES
    */
    Route::get('/mes-commandes', [OrderController::class, 'myOrders'])->name('orders.index');


    /*
    | 🎫 LICENCES
    */
    Route::get('/mes-licences', [LicenseController::class, 'myLicenses'])->name('licenses.index');
    Route::post('/licences/demande', [LicenseController::class, 'store'])->name('licenses.store');
});


/*
|--------------------------------------------------------------------------
| 👤 ROUTES JOUEUR
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::view('/planning', 'pages.joueur.planning')->name('joueur.planning');
    Route::view('/paiement-joueur', 'pages.joueur.paiement')->name('joueur.paiement');
    Route::get('/mes-commandes/{id}', [OrderController::class, 'show'])
        ->name('orders.show');
    Route::get('/buvette', [BuvetteController::class, 'index'])->name('buvette');
});


/*
|--------------------------------------------------------------------------
| 🛠️ ROUTES ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/produits', [ProductController::class, 'adminIndex'])->name('admin.products');

    Route::get('/admin/produits/create', [ProductController::class, 'create'])->name('admin.products.create');

    Route::post('/admin/produits', [ProductController::class, 'store'])->name('admin.products.store');

    Route::get('/admin/produits/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');

    Route::put('/admin/produits/{id}', [ProductController::class, 'update'])->name('admin.products.update');

    Route::delete('/admin/produits/{id}', [ProductController::class, 'destroy'])->name('admin.products.delete');
    Route::get('/admin/commandes', [OrderController::class, 'adminOrders'])->name('admin.orders');
    Route::post('/admin/commandes/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.status');
    Route::get('/admin/buvette', [BuvetteController::class, 'adminIndex'])->name('admin.buvette');

    Route::get('/admin/buvette/create', [BuvetteController::class, 'create'])->name('admin.buvette.create');

    Route::post('/admin/buvette', [BuvetteController::class, 'store'])->name('admin.buvette.store');

    Route::delete('/admin/buvette/{id}', [BuvetteController::class, 'destroy'])->name('admin.buvette.delete');
});


/*
|--------------------------------------------------------------------------
| 🔐 AUTH (Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
