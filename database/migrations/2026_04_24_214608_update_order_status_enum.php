<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Ne pas oublier cet import !

return new class extends Migration
{
    public function up(): void
    {
        // Si on utilise SQLite, on ignore cette commande spécifique à MySQL
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        DB::statement("
            ALTER TABLE orders
            MODIFY status ENUM(
                'en_preparation',
                'payee',
                'annulee',
                'expediee',
                'livree'
            ) DEFAULT 'en_preparation'
        ");
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        DB::statement("
            ALTER TABLE orders
            MODIFY status ENUM(
                'en_preparation',
                'payee',
                'annulee'
            ) DEFAULT 'en_preparation'
        ");
    }
};
