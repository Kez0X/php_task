<?php

const ROUTES = [
    'GET' => [
        '/php_task-main/Pho3nix/' => [
            'controller' => App\Controller\MainController::class,
            'method' => 'home'
        ],
        '/php_task-main/Pho3nix/signup' => [
            'controller' => App\Controller\MainController::class,
            'method' => 'signup'
        ],
        '/php_task-main/Pho3nix/logout' => [
            'controller' => App\Controller\UserController::class,
            'method' => 'signout'
        ],
        '/php_task-main/Pho3nix/tasks' => [
            'controller' => App\Controller\TaskController::class,
            'method' => 'index'
        ],
    ],
    'POST' => [
        '/php_task-main/Pho3nix/tasks' => [
            'controller' => App\Controller\TaskController::class,
            'method' => 'index'
        ],
        '/php_task-main/Pho3nix/signin' => [
            'controller' => App\Controller\UserController::class,
            'method' => 'signin'
        ],
        '/php_task-main/Pho3nix/signup' => [
            'controller' => App\Controller\UserController::class,
            'method' => 'signup'
        ]
    ]
];

?>
