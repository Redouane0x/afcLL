<?php

namespace App\Http\Controllers;

use App\Models\Product; // Ne pas oublier d'importer le modèle !
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Fonction qui renvoie tous les produits de la boutique
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }
}
