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

        if ($product->sizes && !$request->size) {
            return back()->with('error', 'Veuillez sélectionner une taille');
        }

        if ($quantity > $product->stock_quantity) {
            return back()->with('error', 'Stock insuffisant');
        }

        $cart = session()->get('cart', []);

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

        return redirect()->route('cart');
    }

    public function cart()
    {
        return view('pages.shop.cart', [
            'cart' => session()->get('cart', [])
        ]);
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) return redirect()->route('cart');

        return view('pages.shop.checkout', compact('cart'));
    }

    public function processPayment()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) return redirect()->route('cart');

        $total = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']);

        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $total,
            'status' => 'en_preparation',
        ]);

        foreach ($cart as $item) {

            $product = Product::find($item['product_id']);

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

        return redirect()->route('orders.index');
    }

    public function myOrders()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('products')
            ->latest()
            ->get();

        return view('pages.shop.orders', compact('orders'));
    }

    public function adminOrders()
    {
        $orders = Order::with('products', 'user')->latest()->get();

        return view('pages.admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        Order::findOrFail($id)->update([
            'status' => $request->status
        ]);

        return back();
    }

    public function remove($index)
    {
        $cart = session()->get('cart', []);
        unset($cart[$index]);
        session()->put('cart', array_values($cart));

        return back();
    }

    // 🔥 FIX PRINCIPAL
    public function show($id)
    {
        $query = Order::with('products', 'user');

        if (auth()->user()->role !== 'admin') {
            $query->where('user_id', auth()->id());
        }

        $order = $query->findOrFail($id);

        return view('pages.shop.order-show', compact('order'));
    }

    public function export()
    {
        $orders = Order::with('user')->get();

        return response()->stream(function () use ($orders) {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['ID', 'User', 'Total', 'Status']);

            foreach ($orders as $o) {
                fputcsv($file, [
                    $o->id,
                    $o->user?->name,
                    $o->total_price,
                    $o->status
                ]);
            }

            fclose($file);

        }, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=orders.csv"
        ]);
    }
}
