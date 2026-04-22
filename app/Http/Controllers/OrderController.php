<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Passer une commande
    public function store(Request $request)
    {
        // On s'attend à recevoir le prix total ET un tableau de produits (avec leur id et quantité)
        $validated = $request->validate([
            'total_price' => 'required|numeric',
            'products' => 'required|array', // ex: [ ["id" => 1, "quantity" => 2], ["id" => 2, "quantity" => 1] ]
        ]);

        // 1. On crée la commande principale
        $order = Order::create([
            'user_id' => $request->user()->id,
            'total_price' => $validated['total_price'],
            'status' => 'en_preparation',
        ]);

        // 2. On attache chaque produit à cette commande avec sa quantité
        foreach ($request->products as $product) {
            $order->products()->attach($product['id'], ['quantity' => $product['quantity']]);
        }

        // On renvoie la commande complète avec ses produits inclus !
        return response()->json([
            'message' => 'Commande validée avec succès !',
            'order' => $order->load('products')
        ], 201);
    }

    // Voir mes commandes
    public function myOrders(Request $request)
    {
        $orders = Order::where('user_id', $request->user()->id)->get();
        return response()->json($orders);
    }
}
