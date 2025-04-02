<?php

declare(strict_types=1);

// Mise en place des erreurs en mode développement
error_reporting(E_ALL);
ini_set('display_errors', '1');

// On démarre la session si nécessaire
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// On importe le routeur de notre framework
use Pho3nix\lib\Router\Router;

// Charger l'autoloader
require dirname(__DIR__) . '/lib/autoload.php';

var_dump(class_exists('Pho3nix\Router\Router'));

try {
    // On instancie et lance le routeur
    new Router();
} catch (Throwable $e) {
    // Gérer les erreurs proprement
    http_response_code(500);
    echo "Une erreur interne est survenue.";
    
    // On met les erreurs dans un journal pour le débogage
    error_log($e->getMessage());
}

?>
