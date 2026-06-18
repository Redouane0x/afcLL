<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();

            // Clé étrangère vers la table users (si l'user est supprimé, sa licence l'est aussi)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Le chemin vers le fichier uploadé (PDF, JPG, etc.)
            $table->string('document_path');

            // Le type de demande (création ou renouvellement)
            $table->string('type_demande')->default('creation');

            // Le statut de la demande (en attente, validée, refusée)
            $table->string('status')->default('en attente');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licenses');
    }
};
