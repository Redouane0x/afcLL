<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class BuvetteController extends Controller
{
    public function index()
    {
        $products = Product::where('type', 'buvette')->get();
        return view('pages.buvette.index', compact('products'));
    }

    public function adminIndex()
    {
        $products = Product::where('type', 'buvette')->get();
        return view('pages.admin.buvette.index', compact('products'));
    }

    // ➕ Admin - create
    public function create()
    {
        return view('pages.admin.buvette.create');
    }

    // Admin - store
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
        } else {
            $path = null;
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock_quantity' => $request->stock_quantity,
            'type' => 'buvette',
            'image_url' => $path,
        ]);

        return redirect()->route('admin.buvette')->with('success', 'Produit ajouté');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return back()->with('success', 'Produit supprimé');
    }
}
