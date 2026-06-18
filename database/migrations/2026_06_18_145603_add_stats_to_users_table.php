<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Informations de jeu
            $table->string('position')->default('Non défini'); // ex: Attaquant, Milieu...
            $table->integer('rating')->default(50); // Note globale (ex: 82)

            // Statistiques principales
            $table->integer('buts')->default(0);
            $table->integer('passes')->default(0);
            $table->integer('matchs_gagnes')->default(0);

            // Détails physiques et techniques
            $table->integer('matchs_joues')->default(0);
            $table->integer('reussite_passes')->default(0); // Pourcentage (ex: 75)
            $table->string('pied_fort')->default('Droit'); // Droit ou Gauche
            $table->string('taille')->default('1m75');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'position', 'rating', 'buts', 'passes',
                'matchs_gagnes', 'matchs_joues', 'reussite_passes',
                'pied_fort', 'taille'
            ]);
        });
    }
};
