<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // --- INSCRIPTION ---
    public function register(Request $request)
    {
        // 1. On vérifie que les données envoyées sont correctes
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // 2. On crée l'utilisateur dans la base de données
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), // On crypte le mot de passe !
        ]);

        // 3. On lui donne un "badge" (Jeton/Token) pour qu'il soit connecté tout de suite
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Inscription réussie',
            'access_token' => $token,
            'user' => $user
        ]);
    }

    // --- CONNEXION ---
    public function login(Request $request)
    {
        // 1. On cherche l'utilisateur avec son email
        $user = User::where('email', $request->email)->first();

        // 2. Si on ne le trouve pas OU que le mot de passe est faux -> Erreur
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Identifiants incorrects'], 401);
        }

        // 3. Si tout est bon, on lui donne un nouveau jeton d'accès
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Connexion réussie',
            'access_token' => $token,
            'user' => $user
        ]);
    }
}
