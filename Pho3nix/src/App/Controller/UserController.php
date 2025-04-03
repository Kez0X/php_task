<?php

namespace App\Controller;

use App\Model\UserModel;

class UserController
{
    // Pour se connecter
    public function signin(): void
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                echo "Tous les champs sont requis.";
                return;
            }

            $userModel = new UserModel();
            $user = $userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                header('Location: /');
                exit;
            } else {
                echo "Identifiants incorrects.";
            }
        }
    }

    // Pour s'inscrire
    public function signup(): void
    {
        // Si la méthode est POST (c'est-à-dire que le formulaire a été soumis)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            // Validation simple (vérifier si les mots de passe correspondent)
            if ($password !== $confirmPassword) {
                echo "Les mots de passe ne correspondent pas.";
                return;
            }

            // Validation de l'email (ici, on fait une vérification de base)
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "L'email est invalide.";
                return;
            }

            // Créer l'utilisateur en base de données
            $user = new UserModel();
            $result = $user->createUser($email, $password);

            // Si la création réussit
            if ($result) {
                echo "Inscription réussie ! Vous pouvez maintenant vous connecter.";
                header('Location: /');
                exit;
            } else {
                echo "Une erreur est survenue lors de l'inscription.";
            }
        }
    }

    public function signout(): void
    {
        // On détruit toutes les données de session
        session_unset();
        session_destroy();
        
        // Redirection vers la page de connexion
        header('Location: /');
        exit;
    }
}

?>
