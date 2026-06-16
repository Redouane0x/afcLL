<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('type', '!=', 'buvette')
            ->latest()
            ->get();

        if (auth()->check() && auth()->user()->role === 'admin') {
            return view('pages.admin.products.index', compact('products'));
        }

        return view('pages.shop.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::where('type', '!=', 'buvette')
            ->findOrFail($id);

        return view('pages.shop.show', compact('product'));
    }

    public function create()
    {
        return view('pages.admin.products.create');

    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'type' => 'required|in:tshirt,short,manteau,autre',
            'sizes' => 'nullable|array', // ✅ FIX
            'material' => 'nullable|string',
            'dimensions' => 'nullable|string',
        ]);

        // IMAGE
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $path = $file->storeAs(
                'products',
                time() . '.' . $file->getClientOriginalExtension(),
                'public'
            );

            $data['image_url'] = $path;
        }

        // 🔥 IMPORTANT
        $data['sizes'] = $request->sizes
            ? implode(',', $request->sizes)
            : null;

        $data['customizable'] = $request->has('customizable');

        Product::create($data);

        return redirect()
            ->route('admin.produits.index') // ✅ FIX ROUTE
            ->with('success', 'Produit ajouté');
    }

    public function edit($id)
    {
        $product = Product::where('type', '!=', 'buvette')
            ->findOrFail($id);

        return view('pages.admin.products.edit', compact('product'));
    }

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
            'sizes' => 'nullable|array',
            'material' => 'nullable|string',
            'dimensions' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $path = $file->storeAs(
                'products',
                time() . '.' . $file->getClientOriginalExtension(),
                'public'
            );

            $data['image_url'] = $path;
        }

        $data['sizes'] = $request->sizes
            ? implode(',', $request->sizes)
            : null;

        $data['customizable'] = $request->has('customizable');

        $product->update($data);

        return redirect()
            ->route('admin.produits.index')
            ->with('success', 'Produit modifié');
    }

    public function destroy($id)
    {
        Product::where('type', '!=', 'buvette')
            ->findOrFail($id)
            ->delete();

        return redirect()
            ->route('admin.produits.index')
            ->with('success', 'Produit supprimé');
    }
}
