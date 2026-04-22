<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; // Très important d'importer le modèle !

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Maillot Domicile AFCLL',
            'description' => 'Le maillot officiel rouge et noir pour la saison en cours.',
            'price' => 35.00,
            'stock_quantity' => 50,
            'image_url' => 'maillot-domicile.png'
        ]);

        Product::create([
            'name' => 'Short d\'entraînement',
            'description' => 'Short léger et respirant pour les entraînements.',
            'price' => 15.50,
            'stock_quantity' => 100,
            'image_url' => 'short-entrainement.png'
        ]);

        Product::create([
            'name' => 'Chaussettes de match',
            'description' => 'Chaussettes renforcées aux couleurs du club.',
            'price' => 8.00,
            'stock_quantity' => 80,
            'image_url' => 'chaussettes.png'
        ]);
    }
}
