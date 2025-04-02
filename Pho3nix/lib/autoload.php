<?php

spl_autoload_register(function ($class) {
    // Remplacer les backslashes par des slashes et ajouter .php à la fin
    $classPath = str_replace('\\', '/', $class) . '.php';
    
    // Définir les chemins pour rechercher les classes
    $paths = [
        __DIR__ . '/../src/',    // Pour les classes dans /src/
        __DIR__ . '/../lib/',    // Pour les classes dans /lib/
    ];

    foreach ($paths as $path) {
        $file = $path . $classPath;
        echo "Recherche : " . $file . "<br>";  // Debug
        if (file_exists($file)) {
            require_once $file;
            echo "✅ Chargé : " . $file . "<br>";  // Debug
            return;
        }
    }

    echo "❌ Fichier introuvable : " . $classPath . "<br>";  // Debug
});

?>