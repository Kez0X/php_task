<?php

namespace App\Model;

class UserModel
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

    // Récupérer un utilisateur par son email
    public function getUserByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        return $user ?: null;
    }

    // Créer un nouvel utilisateur
    public function createUser(string $email, string $password): bool
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $this->db->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
        return $stmt->execute([
            'email' => $email,
            'password' => $hashedPassword,
        ]);
    }
}
?>