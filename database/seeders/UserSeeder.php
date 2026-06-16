<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 👻 DEV
        User::updateOrCreate(
            ['email' => 'dev@afcll.com'], // 👈 Laravel cherche cet email
            [
                'name' => 'Développeur',
                'password' => Hash::make('GrosSecret'),
                'role' => 'dev',
                'number' => null,
            ] // 👈 S'il le trouve, il met à jour ça. Sinon, il le crée.
        );

        // 👑 SUPER ADMIN
        User::updateOrCreate(
                ['email' => 'superadmin@afcll.com'],
            [
                'name' => 'Président AFC',
                'password' => Hash::make('GrosSecret'),
                'role' => 'super_admin',
                'number' => null,
            ]
        );

        // 🛡️ ADMIN
        User::updateOrCreate(
            ['email' => 'admin@afcll.com'],
            [
                'name' => 'Admin AFC',
                'password' => Hash::make('GrosSecret'),
                'role' => 'admin',
                'number' => null,
            ]
        );

        // ⚽ JOUEUR LICENCIÉ
        User::updateOrCreate(
            ['email' => 'licencie@afcll.com'],
            [
                'name' => 'Joueur Validé',
                'password' => Hash::make('GrosSecret'),
                'role' => 'joueur_licencie',
                'number' => 7,
            ]
        );

        // 🏃 JOUEUR
        User::updateOrCreate(
            ['email' => 'joueur@afcll.com'],
            [
                'name' => 'Nouveau Joueur',
                'password' => Hash::make('GrosSecret'),
                'role' => 'joueur',
                'number' => 10,
            ]
        );

        // 👤 USER CLASSIQUE
        User::updateOrCreate(
            ['email' => 'user@afcll.com'],
            [
                'name' => 'Supporter',
                'password' => Hash::make('GrosSecret'),
                'role' => 'user',
                'number' => null,
            ]
        );
    }
}
