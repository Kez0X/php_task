<?php

namespace App\Model;

class TaskModel
{
    private \PDO $db;

    public function __construct()
    {
        try {
            $this->db = new \PDO(
                "mysql:host=mysql03.univ-lyon2.fr;dbname=php_lbaudrant",
                "php_lbaudrant",
                "ADtXK8mIA-9Q6wXO7Joahd60n",
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
                ]
            );
        } catch (\PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    // Récupérer les tâches d'un utilisateur
    public function getUserTasks(int $userId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
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
