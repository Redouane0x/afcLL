<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\FootMatch; // <-- On change ici// Assure-toi que ce modèle existe bien !

class ScrapeFootclubs extends Command
{
    // C'est la commande que tu taperas dans le terminal
    protected $signature = 'footclubs:sync';
    protected $description = 'Lit le butin HTML de Dusk et enregistre les matchs en BDD';

    public function handle()
    {
        $this->info('🚀 Lancement de l\'extracteur AFCLL...');

        $fichier = storage_path('logs/matchs_source.html');

        // 1. On vérifie si Dusk a bien fait son travail avant
        if (!file_exists($fichier)) {
            $this->error("❌ Le fichier HTML est introuvable. Lance d'abord : php artisan dusk tests/Browser/FootclubsSync.php");
            return;
        }

        $this->info("🔍 Lecture du fichier HTML déposé par le robot...");

        // 2. On lit le fichier local
        $html = file_get_contents($fichier);
        $crawler = new Crawler($html);

        // 3. On extrait les données du tableau exact
        $matchsExtraits = $crawler->filter('#EX_RENCONTRES_GRD tr')->each(function (Crawler $node, $i) {
            // On ignore la première ligne (les titres des colonnes)
            if ($i === 0) return null;

            $tds = $node->filter('td');
            if ($tds->count() < 7) return null;

            // Découpage des équipes
            $equipesBrutes = trim($tds->eq(3)->text());
            $equipes = explode(' - ', $equipesBrutes);

            return [
                'footclubs_id'     => trim($tds->eq(6)->text()),
                'competition'      => trim($tds->eq(0)->text()),
                'date'             => trim($tds->eq(1)->text()),
                'equipe_domicile'  => trim($equipes[0] ?? 'Inconnu'),
                'equipe_exterieur' => trim($equipes[1] ?? 'Inconnu'),
                'score'            => trim($tds->eq(4)->text()),
            ];
        });

        // On enlève les lignes vides
        $matchsExtraits = array_filter($matchsExtraits);
        $compteur = 0;

        $this->info("⚙️ Sauvegarde dans la base de données...");

        // 4. On enregistre en base de données
        foreach ($matchsExtraits as $matchData) {
            $scoreNettoye = ($matchData['score'] !== '-') ? $matchData['score'] : null;

            FootMatch::updateOrCreate(
                ['footclubs_id' => $matchData['footclubs_id']],
                [
                    'competition'      => $matchData['competition'],
                    'date'             => $matchData['date'],
                    'equipe_domicile'  => $matchData['equipe_domicile'],
                    'equipe_exterieur' => $matchData['equipe_exterieur'],
                    'score'            => $scoreNettoye,
                ]
            );
            $compteur++;
        }

        $this->info("✅ Succès absolu ! $compteur matchs ont été insérés/mis à jour dans ta base de données.");
    }
}
