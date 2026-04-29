<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AgendaController;

Route::view('/', 'pages.home');
Route::view('/agenda', 'pages.agenda');
Route::view('/club', 'pages.club');
Route::view('/actualites', 'pages.actualites');
Route::view('/galerie', 'pages.galerie');
Route::view('/contact', 'pages.contact');

Route::get('/boutique', [ProductController::class, 'index'])->name('boutique');
Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda');
Route::middleware(['auth', 'verified'])->group(function () {

    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::get('/mes-licences', [LicenseController::class, 'myLicenses'])->name('licenses.index');
    Route::post('/licences/demande', [LicenseController::class, 'store'])->name('licenses.store');

    Route::get('/mes-commandes', [OrderController::class, 'myOrders'])->name('orders.index');
    Route::post('/commander', [OrderController::class, 'store'])->name('orders.store');
});

require __DIR__.'/auth.php';
