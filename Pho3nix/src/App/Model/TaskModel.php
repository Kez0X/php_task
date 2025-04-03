<?php

namespace App\Model;

class TaskModel
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = new \PDO("mysql:host=localhost;dbname=task_manager", "root", "");
    }

    public function getUserTasks(int $userId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}

?>