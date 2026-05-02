<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Facebook\WebDriver\WebDriverBy;

class FootclubsSync extends DuskTestCase
{
    public function testExtractionMatchs()
    {
        $this->browse(function (Browser $browser) {
            echo "\n🚀 Étape 1 : Connexion...\n";

            $browser->visit('https://footclubs.fff.fr/extrafoot/extra_login')
                ->waitFor('#username', 10)
                ->type('#username', 'LINISS')
                ->type('#password', 'Kamelia15032021') // <-- MOT DE PASSE
                ->click('#btnseconnecter')
                ->pause(5000);

            echo "🟡 Étape 2 : Vérification du message d'information...\n";

            $frameWork = $browser->driver->findElement(WebDriverBy::name('work'));
            $browser->driver->switchTo()->frame($frameWork);

            $boutonsFermer = $browser->driver->findElements(WebDriverBy::cssSelector('input[value="Fermer"]'));
            if (count($boutonsFermer) > 0) {
                echo " -> Bouton 'Fermer' détecté, on clique !\n";
                $boutonsFermer[0]->click();
                $browser->pause(2000);
            }

            $browser->driver->switchTo()->defaultContent();

            echo "🗂️ Étape 3 : Navigation dans le menu (Infiltration JS)...\n";

            $frameMenu = $browser->driver->findElement(WebDriverBy::name('menu'));
            $browser->driver->switchTo()->frame($frameMenu);

            $browser->driver->executeScript("document.getElementById('menu7').click();");
            $browser->pause(2000);

            $browser->driver->executeScript("document.getElementById('EXA_7_5').click();");
            $browser->pause(5000);

            $browser->driver->switchTo()->defaultContent();

            echo "📂 Étape 4 : Atterrissage sur le formulaire...\n";
            $browser->driver->switchTo()->frame($frameWork);

            echo "🎯 Étape 5 : Clic sur 'Afficher' pour voir les matchs...\n";

            // On utilise JavaScript pour cliquer sur l'image qui sert de bouton
            $browser->driver->executeScript("document.getElementsByName('BTN_RECHERCHE_EXT')[0].click();");

            // On attend 5 bonnes secondes que le tableau des matchs se génère
            $browser->pause(5000);

            // On prend la photo ultime !
            $browser->screenshot('matchs_finaux');

            // On sauvegarde le code source contenant enfin le tableau de tes matchs !
            $html = $browser->driver->getPageSource();
            file_put_contents(storage_path('logs/matchs_source.html'), $html);

            echo "✅ Mission accomplie, le trésor est à nous !\n";
            echo "📸 Ouvre l'image : tests/Browser/screenshots/matchs_finaux.png\n";
        });
    }
}
