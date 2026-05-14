<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Affiche la liste de tous les utilisateurs
     */
    public function index()
    {
        $currentUser = auth()->user();

        // On commence la requête
        $query = User::query();

        // 🛡️ LE BOUCLIER : Si je ne suis pas 'dev', je ne vois pas les 'devs'
        if ($currentUser->role !== 'dev') {
            $query->where('role', '!=', 'dev');
        }

        // On trie par les plus récents et on pagine (15 par page)
        $users = $query->latest()->paginate(15);

        // Assure-toi d'avoir créé cette vue dans resources/views/admin/users/index.blade.php
        return view('admin.users.index', compact('users'));
    }

    /**
     * Met à jour le rôle d'un utilisateur spécifique
     */
    public function updateRole(Request $request, User $user)
    {
        $currentUser = auth()->user();

        // 1. SÉCURITÉ ABSOLUE : Un non-dev ne peut pas modifier un profil dev
        // Même s'il essaie de forcer l'URL ou de pirater le formulaire HTML
        if ($currentUser->role !== 'dev' && $user->role === 'dev') {
            abort(403, 'Action non autorisée. Vous ne pouvez pas modifier un compte développeur.');
        }

        // 2. On récupère les rôles que l'utilisateur ACTUEL a le droit d'attribuer
        $allowedRoles = $currentUser->assignableRoles();

        // 3. On vérifie que le rôle envoyé dans le formulaire fait bien partie de ses droits
        $request->validate([
            'role' => ['required', Rule::in($allowedRoles)],
        ], [
            'role.in' => 'Vous n\'avez pas l\'autorisation d\'attribuer ce rôle.'
        ]);

        // 4. On sauvegarde le nouveau rôle
        $user->update([
            'role' => $request->role
        ]);

        // 5. On redirige avec un message de succès
        return back()->with('success', 'Le rôle de ' . $user->name . ' a été mis à jour avec succès !');
    }
}
