<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Affiche l'agenda public du club
     */
    public function index()
    {
        // On récupère les événements à venir (ou tous) triés par date
        $events = Agenda::orderBy('date_heure', 'asc')->get();

        // On renvoie la vue publique de l'agenda
        return view('pages.agenda', compact('events'));
    }
}
