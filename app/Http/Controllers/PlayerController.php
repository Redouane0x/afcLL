<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function show($id)
    {
        // On récupère le joueur (utilisateur) avec ses équipes
        $player = User::with('teams')->findOrFail($id);

        return view('pages.players.show', compact('player'));
    }
}
