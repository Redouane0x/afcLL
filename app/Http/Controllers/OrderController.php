<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | 🛒 AJOUT AU PANIER
    |--------------------------------------------------------------------------
    */

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $quantity = max(1, (int)$request->quantity);

        // 🚫 STOCK
        if ($quantity > $product->stock_quantity) {
            return back()->with('error', 'Stock insuffisant (max: ' . $product->stock_quantity . ')');
        }

        $cart = session()->get('cart', []);

        // 🔥 cumul dans panier
        $existingQuantity = collect($cart)
            ->where('product_id', $product->id)
            ->sum('quantity');

        if (($existingQuantity + $quantity) > $product->stock_quantity) {
            return back()->with('error', 'Stock insuffisant total');
        }

        $cart[] = [
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'size' => $request->size,
            'custom_name' => $request->custom_name,
            'custom_number' => $request->custom_number,
            'quantity' => $quantity,
        ];

        session()->put('cart', $cart);

        return redirect()->route('cart')->with('success', 'Produit ajouté au panier');
    }

    /*
    |--------------------------------------------------------------------------
    | 🛒 PANIER
    |--------------------------------------------------------------------------
    */

    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('pages.shop.cart', compact('cart'));
    }

    /*
    |--------------------------------------------------------------------------
    | 💳 CHECKOUT
    |--------------------------------------------------------------------------
    */

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart');
        }

        return view('pages.shop.checkout', compact('cart'));
    }

    /*
    |--------------------------------------------------------------------------
    | 💰 PAIEMENT
    |--------------------------------------------------------------------------
    */

    public function processPayment(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart');
        }

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $total,
            'status' => 'en_preparation', // 🔥 corrigé (important)
        ]);

        foreach ($cart as $item) {

            $product = Product::find($item['product_id']);

            // 🔻 DÉCRÉMENT STOCK
            if ($product) {
                $product->decrement('stock_quantity', $item['quantity']);
            }

            $order->products()->attach($item['product_id'], [
                'quantity' => $item['quantity'],
                'custom_name' => $item['custom_name'],
                'custom_number' => $item['custom_number'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.index')->with('success', 'Commande validée');
    }

    /*
    |--------------------------------------------------------------------------
    | 📦 MES COMMANDES (USER)
    |--------------------------------------------------------------------------
    */

    public function myOrders(Request $request)
    {
        $orders = Order::where('user_id', $request->user()->id)
            ->with('products')
            ->latest()
            ->get();

        return view('pages.shop.orders', compact('orders'));
    }

    /*
    |--------------------------------------------------------------------------
    | 🛠️ ADMIN COMMANDES
    |--------------------------------------------------------------------------
    */

    public function adminOrders(Request $request)
    {
        $query = Order::with('products', 'user');

        // 🔥 filtre status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // 🔥 recherche user
        if ($request->search) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $orders = $query->latest()->get();

        return view('pages.admin.orders.index', compact('orders'));
    }

    /*
    |--------------------------------------------------------------------------
    | 🔄 UPDATE STATUS (ADMIN)
    |--------------------------------------------------------------------------
    */

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Statut mis à jour');
    }

    /*
    |--------------------------------------------------------------------------
    | ❌ REMOVE PANIER
    |--------------------------------------------------------------------------
    */

    public function remove($index)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$index])) {
            unset($cart[$index]);
            session()->put('cart', array_values($cart));
        }

        return back();
    }

    /*
    |--------------------------------------------------------------------------
    | 📄 DETAIL COMMANDE
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $order = Order::with('products')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('pages.shop.order-show', compact('order'));
    }
    public function export()
    {
        $orders = Order::with('user', 'products')->get();

        $filename = "commandes.csv";

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
        ];

        $callback = function () use ($orders) {
            $file = fopen('php://output', 'w');

            // entête CSV
            fputcsv($file, ['ID', 'Utilisateur', 'Total', 'Statut', 'Date']);

            foreach ($orders as $order) {
                fputcsv($file, [
                    $order->id,
                    $order->user?->name,
                    $order->total_price,
                    $order->status,
                    $order->created_at,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
