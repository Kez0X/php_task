<?php

declare(strict_types=1);

// Activation des erreurs pour le debug
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Démarrer la session si nécessaire
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Charger l'autoloader
require dirname(__DIR__, 1) . '/Pho3nix/lib/autoload.php';

// Vérifier si la classe Router est bien chargée
if (!class_exists('Router\Router')) {
    die("❌ ERREUR : La classe Router n'a pas été trouvée.");
}

// Importer et instancier le routeur
use Router\Router;

try {
    new Router();
} catch (Throwable $e) {
    http_response_code(500);
    echo "❌ Une erreur interne est survenue.";
    error_log($e->getMessage());
}

?>