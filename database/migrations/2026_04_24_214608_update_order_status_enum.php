<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration

{

    public function up(): void

    {

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
