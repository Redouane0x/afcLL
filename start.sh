#!/bin/bash

echo "🚀 Lancement du projet AFCLL..."

# Aller dans le dossier du projet (sécurité)
cd "$(dirname "$0")"

# Vérifier Node
if ! command -v npm &> /dev/null
then
    echo "❌ npm non installé"
    exit
fi

# Installer dépendances si besoin
if [ ! -d "node_modules" ]; then
    echo "📦 Installation npm..."
    npm install
fi

# Lancer Laravel
echo "📡 Lancement Laravel..."
php artisan serve > /dev/null 2>&1 &

# Lancer Vite
echo "🎨 Lancement Vite..."
npm run dev > /dev/null 2>&1 &

# Attendre que ça démarre
sleep 3

# Ouvrir navigateur (Mac)
echo "🌐 Ouverture du site..."
open http://127.0.0.1:8000

echo "✅ Projet lancé avec succès !"
echo "👉 Laravel + Vite actifs"

# Garder le script actif (optionnel)
wait
