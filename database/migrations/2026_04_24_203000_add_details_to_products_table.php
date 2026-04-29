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
        Schema::table('products', function (Blueprint $table) {

            $table->string('sizes')->nullable();        // ex: S,M,L,XL
            $table->string('material')->nullable();     // ex: coton
            $table->string('dimensions')->nullable();   // ex: 70x50 cm

        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {

            $table->dropColumn(['sizes', 'material', 'dimensions']);

        });
    }
};
