<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | 🛒 PANIER (SESSION)
    |--------------------------------------------------------------------------
    */

    // Ajouter au panier
    public function add(Request $request)
    {
        $cart = session()->get('cart', []);

        $cart[] = [
            'product_id' => $request->product_id,
            'name' => $request->name,
            'price' => $request->price,
            'size' => $request->size,
            'custom_name' => $request->custom_name,
            'custom_number' => $request->custom_number,
            'quantity' => 1,
        ];

        session()->put('cart', $cart);

        return redirect()->route('cart')->with('success', 'Produit ajouté au panier');
    }

    // Afficher le panier
    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('pages.shop.cart', compact('cart'));
    }

    /*
    |--------------------------------------------------------------------------
    | 💳 CHECKOUT (PAGE PAIEMENT)
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
    | 💰 TRAITEMENT PAIEMENT
    |--------------------------------------------------------------------------
    */

    public function processPayment(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart');
        }

        // 💰 total
        $total = collect($cart)->sum('price');

        // 📦 création commande
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $total,
            'status' => 'payee',
        ]);

        // 🔗 attacher produits
        foreach ($cart as $item) {
            $order->products()->attach($item['product_id'], [
                'quantity' => $item['quantity'],
                'custom_name' => $item['custom_name'],
                'custom_number' => $item['custom_number'],
            ]);
        }

        // 🧹 vider panier
        session()->forget('cart');

        return redirect()->route('orders.index')->with('success', 'Paiement réussi');
    }

    /*
    |--------------------------------------------------------------------------
    | 📦 MES COMMANDES
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
    | ❌ SUPPRIMER ITEM PANIER
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
    // 📦 LISTE ADMIN
    public function adminOrders()
    {
        $orders = Order::with('products', 'user')->latest()->get();
        return view('pages.admin.orders.index', compact('orders'));
    }

// 🔄 UPDATE STATUS
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Statut mis à jour');
    }
    public function show($id)
    {
        $order = Order::with('products')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('pages.shop.order-show', compact('order'));
    }
}
