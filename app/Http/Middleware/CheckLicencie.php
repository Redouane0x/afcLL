<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLicencie
{
    public function handle(Request $request, Closure $next): Response
    {
        // On autorise les licenciés, mais aussi les admins pour qu'ils puissent gérer la page !
        $vipRoles = ['joueur_licencie', 'admin', 'super_admin', 'dev'];

        if (! auth()->check() || ! in_array(auth()->user()->role, $vipRoles)) {
            abort(403, 'Accès refusé. Cette page est réservée aux joueurs disposant d\'une licence valide.');
        }

        return $next($request);
    }
}
