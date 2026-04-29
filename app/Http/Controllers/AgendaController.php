<?php

namespace App\Http\Controllers;

use App\Models\FootMatch; // Ou MatchModel selon ton alias
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        // On récupère les matchs bruts (objets Eloquent)
        $matchs = FootMatch::all();

        // On les envoie à la vue
        return view('pages.public.agenda', compact('matchs'));
    }

    // Petite fonction pour transformer "25/04/2026" en "2026-04-25" pour le calendrier
    private function formatDate($dateStr) {
        $parts = explode('/', $dateStr);
        return count($parts) == 3 ? "$parts[2]-$parts[1]-$parts[0]" : $dateStr;
    }
}
