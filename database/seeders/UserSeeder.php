<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 👑 ADMIN
        User::create([
            'name' => 'Admin AFC',
            'email' => 'admin@afcll.com',
            'password' => Hash::make('GrosSecret'),
            'role' => 'admin',
            'number' => null,
        ]);

        // 👤 USER CLASSIQUE
        User::create([
            'name' => 'User Test',
            'email' => 'user@afcll.com',
            'password' => Hash::make('GrosSecret'),
            'role' => 'user',
            'number' => null,
        ]);

        // ⚽ JOUEUR
        User::create([
            'name' => 'Joueur AFC',
            'email' => 'joueur@afcll.com',
            'password' => Hash::make('GrosSecret'),
            'role' => 'joueur',
            'number' => 10,
        ]);
    }
}
