<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Infos produit
            $table->string('name'); // Nom (ex: Maillot domicile)
            $table->text('description')->nullable(); // Description

            $table->decimal('price', 8, 2); // Prix

            $table->integer('stock_quantity')->default(0); // Stock

            $table->string('image_url')->nullable(); // Image

            // 🔥 IMPORTANT POUR TON PROJET
            $table->enum('type', ['tshirt', 'short', 'manteau', 'autre'])
                ->default('autre');

            // Permet le flocage (nom + numéro)
            $table->boolean('customizable')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
