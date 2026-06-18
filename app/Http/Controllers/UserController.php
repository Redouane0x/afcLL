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

        // On prépare la requête de base
        $query = User::query();

        // 🛡️ GESTION DES DROITS ET VISIBILITÉ
        if ($currentUser->role === 'admin') {
            // Un "admin" ne voit pas les "super_admin" ni les "dev"
            $query->whereNotIn('role', ['super_admin', 'dev']);

        } elseif ($currentUser->role === 'super_admin') {
            // Un "super_admin" ne voit pas les "dev"
            $query->where('role', '!=', 'dev');
        }
        // (Si c'est le "dev", il voit tout le monde, on ne filtre rien)

        // On exécute la requête avec la pagination (ex: 15 par page)
        $users = $query->paginate(15);

        return view('pages.admin.users.index', compact('users'));
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

    /**
     * Affiche le formulaire de modification des statistiques d'un joueur
     */
    public function editStats(User $user)
    {
        // Sécurité optionnelle : s'assurer que c'est bien un joueur licencié ou un joueur
        if (!in_array($user->role, ['joueur_licencie', 'joueur'])) {
            return redirect()->route('admin.users.index')->withErrors(['error' => 'Cet utilisateur n\'est pas un joueur.']);
        }

        return view('pages.admin.users.stats', compact('user'));
    }

    /**
     * Enregistre les nouvelles statistiques en base de données
     */
    public function updateStats(Request $request, User $user)
    {
        $validated = $request->validate([
            'position' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:99',
            'buts' => 'required|integer|min:0',
            'passes' => 'required|integer|min:0',
            'matchs_gagnes' => 'required|integer|min:0',
            'matchs_joues' => 'required|integer|min:0',
            'reussite_passes' => 'required|integer|min:0|max:100',
            'pied_fort' => 'required|string|max:255',
            'taille' => 'required|string|max:255',
        ]);

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'Les statistiques de ' . $user->name . ' ont été mises à jour.');
    }
}
