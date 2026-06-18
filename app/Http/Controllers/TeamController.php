<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team; // 👈 Très important : on importe le modèle de la base de données

class TeamController extends Controller
{
    /**
     * Affiche la liste publique de toutes les équipes
     */
    public function index()
    {
        // On récupère toutes les équipes depuis la base de données
        $teams = Team::all();

        return view('pages.teams.index', [
            'teams' => $teams
        ]);
    }
    /**
     * Affiche la page publique détaillée d'une équipe
     */
    public function show($slug)
    {
        // On cherche l'équipe dans la base de données via son slug,
        // et on inclut les joueurs (users) qui ont été assignés par l'admin !
        $team = Team::with('users')->where('slug', $slug)->firstOrFail();

        return view('pages.teams.show', [
            'team' => $team
        ]);
    }
}
