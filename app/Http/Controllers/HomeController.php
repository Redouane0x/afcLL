<?php


namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // 📰 3 dernières actus publiées
        $news = News::where('is_published', true)
            ->latest()
            ->take(3)
            ->get();

        // 🛍️ 3 produits (hors buvette si besoin)
        $products = Product::where('type', '!=', 'buvette')
            ->latest()
            ->take(3)
            ->get();

        return view('pages.public.home', compact('news', 'products'));
    }
}
