<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\License;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LicenseController extends Controller
{
    /**
     * Affiche l'historique des demandes de licences de l'utilisateur.
     */
    public function index()
    {
        // On récupère les licences de l'utilisateur connecté, de la plus récente à la plus ancienne
        $licenses = License::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('licenses.index', compact('licenses'));
    }

    /**
     * Affiche le formulaire de demande de licence.
     */
    public function create()
    {
        return view('licenses.create');
    }

    /**
     * Valide et enregistre la nouvelle demande de licence.
     */
    public function store(Request $request)
    {
        // 1. Validation stricte des données
        $request->validate([
            'type_demande' => 'required|string|in:creation,renouvellement',
            'document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:4096', // Max 4MB
        ], [
            'document.required' => 'Le document d\'identité est obligatoire.',
            'document.mimes' => 'Le document doit être un PDF ou une image (JPG, PNG).',
            'document.max' => 'Le fichier ne doit pas dépasser 4 Mo.',
        ]);

        // 2. Upload sécurisé du fichier dans le dossier storage/app/public/licenses
        // N'oublie pas de lancer `php artisan storage:link` si ce n'est pas déjà fait !
        $documentPath = $request->file('document')->store('licenses', 'public');

        // 3. Création de l'entrée en base de données
        License::create([
            'user_id' => Auth::id(),
            'document_path' => $documentPath,
            'type_demande' => $request->type_demande,
            'status' => 'en attente',
        ]);

        // 4. Redirection avec message de succès
        return redirect()->route('dashboard')->with('success', 'Votre demande de licence a bien été envoyée. Elle est en attente de validation par le club.');
    }
}
