<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\OrderController;

// 🟢 ROUTES PUBLIQUES (Tout le monde peut y aller)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/products', [ProductController::class, 'index']);

// 🔴 ROUTES PROTÉGÉES (Il faut le jeton de connexion)
Route::middleware('auth:sanctum')->group(function () {

    // Licences
    Route::post('/licenses', [LicenseController::class, 'store']);
    Route::get('/my-licenses', [LicenseController::class, 'myLicenses']);

    // Commandes Boutique
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/my-orders', [OrderController::class, 'myOrders']);

    // Obtenir les infos du profil connecté
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
