<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    // Demander une nouvelle licence
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string', // ex: U11, U13, Senior
            'price' => 'required|numeric',
        ]);

        // On crée la licence en la liant automatiquement à l'utilisateur connecté
        $license = License::create([
            'user_id' => $request->user()->id, // Récupère l'ID du gars connecté !
            'category' => $validated['category'],
            'price' => $validated['price'],
            'status' => 'en_attente',
        ]);

        return response()->json([
            'message' => 'Demande de licence envoyée avec succès',
            'license' => $license
        ], 201);
    }

    // Voir mes licences
    public function myLicenses(Request $request)
    {
        // Renvoie uniquement les licences de l'utilisateur connecté
        $licenses = License::where('user_id', $request->user()->id)->get();
        return response()->json($licenses);
    }
}
