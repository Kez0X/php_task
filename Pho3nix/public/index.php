<?php

session_start();

require_once '../src/App/Controller/MainController.php';
require_once '../src/App/Controller/UserController.php';
require_once '../src/App/Controller/TaskController.php';

require_once dirname(__DIR__, levels : 1) . '/vendor/autoload.php';

use App\Controller\MainController;
use App\Controller\UserController;
use App\Controller\TaskController;

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'home':
        (new MainController())->home();
        break;

    case 'signin':
        (new UserController())->signin();
        break;

    case 'signup':
        (new UserController())->signup();
        break;

    case 'logout':
        (new UserController())->signout();
        break;

    case 'task_new':
        (new TaskController())->new();
        break;

    case 'task_delete':
        (new TaskController())->delete();
        break;

    case 'task_edit':
        (new TaskController())->edit();
        break;

    default:
        echo "404 - Page introuvable";
        break;
}
