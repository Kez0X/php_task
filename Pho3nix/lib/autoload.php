<?php

spl_autoload_register(function ($class) {
    // Convertir le namespace en chemin de fichier
    $classPath = str_replace('\\', '/', $class) . '.php';

    // Définition des chemins à vérifier
    $paths = [
        __DIR__ . '/../src/',  // Dossier des sources
        __DIR__ . '/',         // Dossier lib
    ];

    foreach ($paths as $path) {
        $file = $path . $classPath;
        echo "🔍 Recherche : " . $file . "<br>"; // Debug
        if (file_exists($file)) {
            require_once $file;
            echo "✅ Chargé : " . $file . "<br>"; // Debug
            return;
        }
    }

    echo "❌ Fichier introuvable : " . $classPath . "<br>"; // Debug
});


?>