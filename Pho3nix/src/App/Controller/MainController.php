<?php

namespace App\Controller;

use App\Model\UserModel;
use App\Model\TaskModel;

class MainController
{
    public function home(): void
    {
        session_start();
        
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user'])) {
            require dirname(__DIR__) . "/View/login.php"; // Vue de connexion
            return;
        }

        $user = $_SESSION['user']; // Contient les infos de l'utilisateur - c'est une variable de session

        // Récupérer les tâches de l'utilisateur
        $taskModel = new TaskModel();
        $tasks = $taskModel->getUserTasks($user['id']);

        // Afficher la page d'accueil avec les tâches
        require dirname(__DIR__) . "/View/home.php";
    }

    public function signup() : void
    {
        require dirname(__DIR__) . "/View/signup.php"; // Vue d'inscription
        return;
    }
}

?>