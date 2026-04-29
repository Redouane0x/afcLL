<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | 🛍️ PARTIE UTILISATEUR
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        // ❌ on exclut la buvette
        $products = Product::where('type', '!=', 'buvette')
            ->latest()
            ->get();

        return view('pages.shop.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::where('type', '!=', 'buvette')
            ->findOrFail($id);

        return view('pages.shop.show', compact('product'));
    }


    /*
    |--------------------------------------------------------------------------
    | 🛠️ PARTIE ADMIN
    |--------------------------------------------------------------------------
    */

    public function adminIndex()
    {
        // ❌ on exclut aussi la buvette côté admin produits
        $products = Product::where('type', '!=', 'buvette')
            ->latest()
            ->get();

        return view('pages.admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('pages.admin.products.create');
    }

    // 💾 STORE
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'type' => 'required|in:tshirt,short,manteau,autre',
            'sizes' => 'nullable|string',
            'material' => 'nullable|string',
            'dimensions' => 'nullable|string',
        ]);

        // 📸 Upload image
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $path = $file->storeAs(
                'products',
                time() . '.' . $file->getClientOriginalExtension(),
                'public'
            );

            $data['image_url'] = $path;
        }

        $data['customizable'] = $request->has('customizable');

        Product::create($data);

        return redirect()
            ->route('admin.products')
            ->with('success', 'Produit ajouté');
    }

    // ✏️ EDIT
    public function edit($id)
    {
        $product = Product::where('type', '!=', 'buvette')
            ->findOrFail($id);

        return view('pages.admin.products.edit', compact('product'));
    }

    // 🔄 UPDATE
    public function update(Request $request, $id)
    {
        $product = Product::where('type', '!=', 'buvette')
            ->findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'type' => 'required|in:tshirt,short,manteau,autre',
            'sizes' => 'nullable|string',
            'material' => 'nullable|string',
            'dimensions' => 'nullable|string',
        ]);

        // 📸 Update image
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $path = $file->storeAs(
                'products',
                time() . '.' . $file->getClientOriginalExtension(),
                'public'
            );

            $data['image_url'] = $path;
        }

        $data['customizable'] = $request->has('customizable');

        $product->update($data);

        return redirect()
            ->route('admin.products')
            ->with('success', 'Produit modifié');
    }

    // ❌ DELETE
    public function destroy($id)
    {
        Product::where('type', '!=', 'buvette')
            ->findOrFail($id)
            ->delete();

        return redirect()
            ->route('admin.products')
            ->with('success', 'Produit supprimé');
    }
}
