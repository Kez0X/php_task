<?php

namespace App\Model;

class TaskModel
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = new \PDO("mysql:host=localhost;dbname=task_manager", "root", "");
    }

    // Récupérer les tâches d'un utilisateur
    public function getUserTasks(int $userId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Ajouter une tâche
    public function addTask(int $userId, string $title): bool
    {
        $stmt = $this->db->prepare("INSERT INTO tasks (user_id, title) VALUES (:user_id, :title)");
        return $stmt->execute([
            'user_id' => $userId,
            'title' => $title
        ]);
    }

    // Modifier une tâche
    public function updateTask(int $taskId, string $title, bool $completed): bool
    {
        $stmt = $this->db->prepare("UPDATE tasks SET title = :title, completed = :completed WHERE id = :id");
        return $stmt->execute([
            'id' => $taskId,
            'title' => $title,
            'completed' => $completed
        ]);
    }

    // Supprimer une tâche
    public function deleteTask(int $taskId): bool
    {
        $stmt = $this->db->prepare("DELETE FROM tasks WHERE id = :id");
        return $stmt->execute(['id' => $taskId]);
    }
}

?>
