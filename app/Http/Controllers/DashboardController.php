<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\License;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // 👑 1. Tableau de bord Administrateur (dev, super_admin, admin)
        if (in_array($user->role, ['dev', 'super_admin', 'admin'])) {

            // On récupère quelques statistiques pour le club
            $stats = [
                'total_users' => User::count(),
                'joueurs_licencies' => User::where('role', 'joueur_licencie')->count(),
                'commandes_attente' => Order::where('status', 'en_attente')->count(),
                // Attention ici : j'ai corrigé 'en_attente' par 'en attente' (avec espace) pour matcher notre BDD
                'licences_attente' => License::where('status', 'en attente')->count(),
            ];

            // On affiche la vue du dashboard admin !
            return view('pages.dashboard.admin', compact('stats'));
        }

        // ⚽ 2. Tableau de bord Joueur Licencié
        if ($user->role === 'joueur_licencie') {
            return view('pages.dashboard.joueur_licencie');
        }

        // 🏃‍♂️ 3. Tableau de bord Joueur en attente
        if ($user->role === 'joueur') {
            return view('pages.dashboard.joueur_attente');
        }

        // 👤 4. Tableau de bord Utilisateur classique
        return view('pages.dashboard.user');
    }
}
