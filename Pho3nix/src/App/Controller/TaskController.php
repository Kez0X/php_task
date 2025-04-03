<?php

namespace App\Controller;

use App\Model\TaskModel;

class TaskController
{
    private TaskModel $taskModel;

    public function __construct()
    {
        $this->taskModel = new TaskModel();
    }

    // Afficher les tâches de l'utilisateur
    public function index(): void
    {

        if (!isset($_SESSION['user'])) {
            // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
            header("Location: /");
            exit;
        }

        $userId = $_SESSION['user']['id'];  // On suppose que l'utilisateur est connecté
        $tasks = $this->taskModel->getUserTasks($userId);
        $user = $_SESSION['user'];  // Récupérer l'utilisateur de la session

        // Si on a une tâche à ajouter
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'])) {
            $this->taskModel->addTask($userId, $_POST['title']);
            header("Location: /tasks");  // Redirection pour recharger la page
            exit;
        }

        // Si on veut supprimer une tâche
        if (isset($_POST['delete_task_id'])) {
            $this->taskModel->deleteTask($_POST['delete_task_id']);
            header("Location: /tasks");  // Redirection pour recharger la page
            exit;
        }

        // Si on veut modifier une tâche
        if (isset($_POST['edit_task_id'])) {
            $this->taskModel->updateTask(
                $_POST['edit_task_id'],
                $_POST['edit_title'],
                isset($_POST['edit_completed']) ? true : false
            );
            header("Location: /tasks");  // Redirection pour recharger la page
            exit;
        }

        // On affiche la vue des tâches avec l'interface pour ajouter/supprimer/éditer
        require dirname(__DIR__) . '/View/home.php';  // On utilise une seule vue pour gérer toutes les tâches
    }
}

?>
