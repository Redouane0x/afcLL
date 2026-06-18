<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\License;
use App\Models\User;

class AdminLicenseController extends Controller
{
    /**
     * Affiche la liste de toutes les demandes de licences pour l'administration.
     */
    public function index(Request $request)
    {
        // On récupère les licences avec les infos de l'utilisateur (eager loading pour optimiser)
        // Triées de la plus récente à la plus ancienne
        $query = License::with('user')->orderBy('created_at', 'desc');

        // Système de filtre dynamique par statut via l'URL (ex: ?status=en attente)
        if ($request->has('status') && in_array($request->status, ['en attente', 'validée', 'refusée'])) {
            $query->where('status', $request->status);
        }

        // On pagine pour éviter de surcharger la page si le club a beaucoup de licenciés
        $licenses = $query->paginate(15);

        // 👈 LA CORRECTION EST ICI : on pointe vers pages/admin/licenses/index.blade.php
        return view('pages.admin.licenses.index', compact('licenses'));
    }

    /**
     * Met à jour le statut d'une demande de licence.
     */
    public function updateStatus(Request $request, $id)
    {
        // 1. Validation stricte du statut autorisé
        $request->validate([
            'status' => 'required|string|in:en attente,validée,refusée',
        ]);

        // 2. Récupération de la licence
        $license = License::findOrFail($id);

        // 3. Mise à jour du statut de la licence
        $license->update([
            'status' => $request->status,
        ]);

        // 4. Logique métier : Si validée, on met à jour le rôle de l'utilisateur
        if ($request->status === 'validée') {
            $user = $license->user;

            // On s'assure de ne pas rétrograder ou écraser un rôle admin/super_admin/dev
            if (in_array($user->role, ['user', 'joueur'])) {
                $user->update(['role' => 'joueur_licencie']);
            }
        }

        // 5. Redirection avec confirmation
        return redirect()->back()->with('success', 'Le statut de la licence a été mis à jour avec succès.');
    }
}
