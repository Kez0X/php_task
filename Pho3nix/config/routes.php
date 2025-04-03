<?php

const ROUTES = [
    'GET' => [
        '/' => [
            'controller' => App\Controller\MainController::class,
            'method' => 'home'
        ],
        '/signup' => [
            'controller' => App\Controller\MainController::class,
            'method' => 'signup'
        ],
        '/logout' => [
            'controller' => App\Controller\UserController::class,
            'method' => 'signout'
        ],
        '/tasks' => [
            'controller' => App\Controller\TaskController::class,
            'method' => 'index'
        ],
    ],
    'POST' => [
        '/tasks' => [
            'controller' => App\Controller\TaskController::class,
            'method' => 'index'
        ],
        '/signin' => [
            'controller' => App\Controller\UserController::class,
            'method' => 'signin'
        ],
        '/signup' => [
            'controller' => App\Controller\UserController::class,
            'method' => 'signup'
        ]
    ]
];

?>
