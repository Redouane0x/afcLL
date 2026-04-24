<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| ROUTES PUBLIQUES (visiteurs)
|--------------------------------------------------------------------------
*/

Route::view('/', 'pages.public.home')->name('home');

Route::view('/agenda', 'pages.public.agenda')->name('agenda');
Route::view('/club', 'pages.public.club')->name('club');
Route::view('/actualites', 'pages.public.actualites')->name('actualites');
Route::view('/galerie', 'pages.public.galerie')->name('galerie');
Route::view('/contact', 'pages.public.contact')->name('contact');
Route::view('/buvette', 'pages.public.buvette')->name('buvette');


/*
|--------------------------------------------------------------------------
| ROUTES UTILISATEURS CONNECTÉS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    /*
    | Dashboard utilisateur
    */
    Route::view('/dashboard', 'pages.user.dashboard')->name('dashboard');


    /*
    |  BOUTIQUE (PRIVÉE)
    */
    Route::get('/boutique', [ProductController::class, 'index'])->name('boutique');


    /*
    |  COMMANDES
    */
    Route::get('/mes-commandes', [OrderController::class, 'myOrders'])->name('orders.index');
    Route::post('/commander', [OrderController::class, 'store'])->name('orders.store');


    /*
    |  LICENCES (joueurs)
    */
    Route::get('/mes-licences', [LicenseController::class, 'myLicenses'])->name('licenses.index');
    Route::post('/licences/demande', [LicenseController::class, 'store'])->name('licenses.store');
});


/*
|--------------------------------------------------------------------------
| ROUTES JOUEUR
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::view('/planning', 'pages.joueur.planning')->name('joueur.planning');
    Route::view('/paiement', 'pages.joueur.paiement')->name('joueur.paiement');
});


/*
|--------------------------------------------------------------------------
| ROUTES ADMIN (à sécuriser avec rôle plus tard)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::view('/admin', 'pages.admin.dashboard')->name('admin.dashboard');

    Route::view('/admin/matchs', 'pages.admin.matchs')->name('admin.matchs');
    Route::view('/admin/produits', 'pages.admin.produits')->name('admin.produits');
    Route::view('/admin/buvette', 'pages.admin.buvette')->name('admin.buvette');
});


/*
|--------------------------------------------------------------------------
| AUTH (Laravel Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
