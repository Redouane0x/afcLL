<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AdminAgendaController extends Controller
{
    public function index()
    {
        // On récupère tous les événements, du plus récent au plus lointain
        $events = Agenda::orderBy('date_heure', 'asc')->get();

        return view('pages.admin.agenda.index', compact('events'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'date_heure' => 'required|date',
            'lieu' => 'nullable|string|max:255',
            'description' => 'nullable|string'
        ]);

        Agenda::create($validated);

        return back()->with('success', 'L\'événement a été ajouté à l\'agenda avec succès !');
    }

    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return back()->with('success', 'L\'événement a été supprimé.');
    }
}
