<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $quantity = max(1, (int)$request->quantity);

        // 🚫 BLOQUER SI STOCK DÉPASSÉ
        if ($quantity > $product->stock_quantity) {
            return back()->with('error', 'Stock insuffisant (max: ' . $product->stock_quantity . ')');
        }

        $cart = session()->get('cart', []);

        // 🔥 éviter de dépasser si déjà dans le panier
        $existingQuantity = collect($cart)
            ->where('product_id', $product->id)
            ->sum('quantity');

        if (($existingQuantity + $quantity) > $product->stock_quantity) {
            return back()->with('error', 'Stock insuffisant total');
        }

        $cart[] = [
            'product_id' => $request->product_id,
            'name' => $request->name,
            'price' => $request->price,
            'size' => $request->size,
            'custom_name' => $request->custom_name,
            'custom_number' => $request->custom_number,
            'quantity' => $quantity,
        ];

        session()->put('cart', $cart);

        return redirect()->route('cart')->with('success', 'Produit ajouté au panier');
    }

    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('pages.shop.cart', compact('cart'));
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart');
        }

        return view('pages.shop.checkout', compact('cart'));
    }

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
            'status' => 'payee',
        ]);

        foreach ($cart as $item) {
            $order->products()->attach($item['product_id'], [
                'quantity' => $item['quantity'],
                'custom_name' => $item['custom_name'],
                'custom_number' => $item['custom_number'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.index')->with('success', 'Paiement réussi');
    }

    public function myOrders(Request $request)
    {
        $orders = Order::where('user_id', $request->user()->id)
            ->with('products')
            ->latest()
            ->get();

        return view('pages.shop.orders', compact('orders'));
    }

    public function remove($index)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$index])) {
            unset($cart[$index]);
            session()->put('cart', array_values($cart));
        }

        return back();
    }

    public function adminOrders()
    {
        $orders = Order::with('products', 'user')->latest()->get();
        return view('pages.admin.orders.index', compact('orders'));
    }

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
