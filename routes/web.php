<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home');
Route::view('/agenda', 'pages.agenda');
Route::view('/boutique', 'pages.boutique');
Route::view('/club', 'pages.club');
Route::view('/actualites', 'pages.actualites');
Route::view('/galerie', 'pages.galerie');
Route::view('/contact', 'pages.contact');
