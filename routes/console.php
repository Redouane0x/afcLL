<?php

use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Artisan;

// 1. Ton robot tourne toutes les 3 heures
Schedule::command('footclubs:sync')->everyThreeHours();

// 2. Pour le lancement immédiat au démarrage, on donne un nom à la tâche
Schedule::call(function () {
    Artisan::call('footclubs:sync');
})->name('sync-on-startup')->onOneServer();
