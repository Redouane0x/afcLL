<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Gère la requête entrante et vérifie les droits d'administration.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Les rôles autorisés à voir le panel d'administration
        $adminRoles = ['dev', 'super_admin', 'admin'];

        // 2. Si l'utilisateur n'est pas connecté OU que son rôle n'est pas dans la liste...
        if (! auth()->check() || ! in_array(auth()->user()->role, $adminRoles)) {

            // ... on bloque l'accès immédiatement (Erreur 403 : Interdit)
            abort(403, 'Accès refusé. Vous n\'êtes pas administrateur du club.');

        }

        // 3. Si tout est bon, on le laisse passer vers la page demandée
        return $next($request);
    }
}
