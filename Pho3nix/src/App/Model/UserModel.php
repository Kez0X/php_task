<?php

namespace App\Model;

class UserModel
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = new \PDO("mysql:host=mysql03.univ-lyon2.fr;dbname=php_lbaudrant", "php_lbaudrant", "ADtXK8mIA-9Q6wXO7Joahd60n");
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    // Récupérer un utilisateur par son email
    public function getUserByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    // Créer un nouvel utilisateur
    public function createUser(string $email, string $password): bool
    {
        // Hacher le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insertion de l'utilisateur dans la base de données
        $stmt = $this->db->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
        return $stmt->execute([
            'email' => $email,
            'password' => $hashedPassword,
        ]);
    }
}

?>