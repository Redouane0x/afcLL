<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminTeamController extends Controller
{
    /**
     * Affiche l'interface d'administration des équipes avec les joueurs licenciés.
     */
    public function index()
    {
        // On récupère toutes les équipes avec leurs joueurs (Eager Loading)
        $teams = Team::with('users')->orderBy('id', 'asc')->get();

        // On récupère uniquement les utilisateurs qui ont validé leur licence
        $licensedPlayers = User::where('role', 'joueur_licencie')->orderBy('name', 'asc')->get();

        return view('pages.admin.teams.index', compact('teams', 'licensedPlayers'));
    }

    /**
     * Crée une nouvelle équipe en base de données.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'nullable|string|max:255',
        ]);

        // Création avec génération automatique du slug pour l'affichage public
        Team::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'age' => $request->age,
        ]);

        return back()->with('success', 'L\'équipe a été créée avec succès.');
    }

    /**
     * Assigne un joueur licencié à une équipe spécifique (Table pivot).
     */
    public function assignPlayer(Request $request, Team $team)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Sécurité : On vérifie si le joueur n'est pas déjà présent dans cette équipe
        if ($team->users()->where('user_id', $request->user_id)->exists()) {
            return back()->withErrors(['error' => 'Ce joueur fait déjà partie de cette équipe.']);
        }

        // On attache le joueur à l'équipe dans la table pivot team_user
        $team->users()->attach($request->user_id);

        return back()->with('success', 'Le joueur a bien été ajouté à l\'équipe.');
    }

    /**
     * Retire un joueur d'une équipe.
     */
    public function removePlayer(Team $team, User $user)
    {
        // On détache la ligne correspondante dans la table pivot team_user
        $team->users()->detach($user->id);

        return back()->with('success', 'Le joueur a été retiré de l\'équipe avec succès.');
    }

    /**
     * Supprime une équipe complète.
     */
    public function destroy(Team $team)
    {
        // Grâce au onDelete('cascade') de ta migration, les liaisons team_user sauteront automatiquement
        $team->delete();

        return back()->with('success', 'L\'équipe a bien été supprimée du système.');
    }
}
