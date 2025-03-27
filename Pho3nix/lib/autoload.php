<?php

spl_autoload_register(function ($class) {
    // On définit les répertoires de base du projet
    $baseDirs = [
        'Pho3nix\\' => __DIR__ . '/Router/', // Pour notre framework dans /lib/Router
        'App\\' => dirname(__DIR__) . '/src/' // Pour notre application dans /src
    ];

    foreach ($baseDirs as $namespace => $baseDir) {
        if (strpos($class, $namespace) === 0) {
            // ON convert le namespace en chemin de fichier
            $relativeClass = str_replace('\\', '/', substr($class, strlen($namespace)));
            $file = $baseDir . $relativeClass . '.php';

            if (file_exists($file)) {
                require $file;
                return;
            }
        }
    }
});

?>
