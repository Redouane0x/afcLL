<?php

namespace App\Http\Controllers;

use App\Models\Product; // Ne pas oublier d'importer le modèle !
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // 1. On va chercher tous les produits dans la base de données
        $products = Product::all();

        // 2. On renvoie la vue Blade en lui passant la variable $products
        return view('pages.public.boutique', compact('products'));
    }
}
