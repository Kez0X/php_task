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
            header("Location: index.php?page=signin");
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $tasks = $this->taskModel->getUserTasks($userId);
        $user = $_SESSION['user'];

        require dirname(__DIR__) . '/View/home.php';
    }

    // Ajouter une tâche
    public function new(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user'], $_POST['title'])) {
            $userId = $_SESSION['user']['id'];
            $title = trim($_POST['title']);
            if ($title !== '') {
                $this->taskModel->addTask($userId, $title);
            }
        }

        header("Location: index.php?page=tasks");
        exit;
    }

    // Supprimer une tâche
    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_task_id'])) {
            $taskId = (int) $_POST['delete_task_id'];
            $this->taskModel->deleteTask($taskId);
        }

        header("Location: index.php?page=tasks");
        exit;
    }

    // Modifier une tâche
    public function edit(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_task_id'], $_POST['edit_title'])) {
            $taskId = (int) $_POST['edit_task_id'];
            $title = trim($_POST['edit_title']);
            $completed = isset($_POST['edit_completed']);

            $this->taskModel->updateTask($taskId, $title, $completed);
        }

        header("Location: index.php?page=tasks");
        exit;
    }
}

?>