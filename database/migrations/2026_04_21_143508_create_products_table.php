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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom du produit (ex: Maillot Domicile)
            $table->text('description')->nullable(); // Description
            $table->decimal('price', 8, 2); // Prix avec 2 décimales (ex: 25.50)
            $table->integer('stock_quantity')->default(0); // Le stock !
            $table->string('image_url')->nullable(); // Lien de la photo
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
