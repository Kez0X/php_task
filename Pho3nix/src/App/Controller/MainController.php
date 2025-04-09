<?php

namespace App\Controller;

use App\Model\UserModel;
use App\Model\TaskModel;

class MainController
{
    public function home(): void
    {
        session_start();

        if (!isset($_SESSION['user'])) {
            // Si pas connecté, afficher la vue de connexion
            require dirname(__DIR__) . "/View/login.php";
            return;
        }

        $user = $_SESSION['user'];

        // Récupérer les tâches via le modèle
        $taskModel = new TaskModel();
        $tasks = $taskModel->getUserTasks($user['id']);

        // Afficher la vue principale
        require dirname(__DIR__) . "/View/home.php";
    }

    public function signup(): void
    {
        session_start();

        // Si déjà connecté, on redirige vers la page d'accueil
        if (isset($_SESSION['user'])) {
            header("Location: index.php?page=home");
            exit;
        }

        // Sinon, afficher le formulaire d'inscription
        require dirname(__DIR__) . "/View/signup.php";
    }

    public function logout(): void
    {
        session_start();
        session_destroy();
        header("Location: index.php?page=home");
        exit;
    }
}
