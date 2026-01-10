<?php
// Atver komandrindu un palaid: php check_schema.php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;

echo "==============================\n";
echo "AppServiceProvider Pārbaude\n";
echo "==============================\n\n";

// 1. Pārbaudam defaultStringLength
echo "1. Schema::defaultStringLength: ";
if (method_exists(Schema::class, 'defaultStringLength')) {
    echo "Metode eksistē\n";
} else {
    echo "Metode NEeksistē\n";
}

// 2. Pārbaudam charset konfigurāciju
echo "2. Datubāzes charset: " . config('database.connections.mysql.charset') . "\n";
echo "3. Datubāzes collation: " . config('database.connections.mysql.collation') . "\n";

// 3. Pārbaudam vai AppServiceProvider ir reģistrēts
$providers = config('app.providers');
$appServiceFound = false;
foreach ($providers as $provider) {
    if (strpos($provider, 'AppServiceProvider') !== false) {
        $appServiceFound = true;
        echo "4. AppServiceProvider reģistrēts: JĀ (" . $provider . ")\n";
    }
}
if (!$appServiceFound) {
    echo "4. AppServiceProvider reģistrēts: NĒ\n";
}

echo "\n==============================\n";
echo "Darbības:\n";
echo "==============================\n";