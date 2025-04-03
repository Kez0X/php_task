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
        ]
    ],
    'POST' => [
        '/task/new' => [
            'controller' => App\Controller\TaskController::class,
            'method' => 'new'
        ],
        '/task/delete/{id}' => [
            'controller' => App\Controller\TaskController::class,
            'method' => 'delete'
        ],
        '/task/edit/{id}' => [
            'controller' => App\Controller\TaskController::class,
            'method' => 'edit'
        ],
        '/task/changeStatus' => [
            'controller' => App\Controller\TaskController::class,
            'method' => 'changeStatus',
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
