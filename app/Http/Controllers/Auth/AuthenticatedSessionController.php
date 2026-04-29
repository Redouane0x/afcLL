<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Affiche la page de login
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Gère la connexion
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // 🔥 REDIRECTION FORCÉE (FIABLE)
        if ($user->role === 'admin') {
            return redirect('/admin/produits');
        }

        if ($user->role === 'joueur') {
            return redirect('/dashboard');
        }

        return redirect('/dashboard');
    }

    /**
     * Déconnexion
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
