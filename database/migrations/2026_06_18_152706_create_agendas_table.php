<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->string('titre'); // ex: "Match vs FC Tartempion"
            $table->string('type')->default('Match'); // Match, Entraînement, Réunion, Tournoi
            $table->dateTime('date_heure'); // Date et heure de l'événement
            $table->string('lieu')->nullable(); // Domicile, Extérieur, ou adresse
            $table->text('description')->nullable(); // Consignes, rdv, etc.
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
