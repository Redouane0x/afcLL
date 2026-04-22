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
            // Clé étrangère pour relier la licence à un utilisateur
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('category'); // ex: U11, U13, Senior
            $table->decimal('price', 8, 2); // Prix de la licence
            $table->string('status')->default('en_attente'); // en_attente, payee
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
