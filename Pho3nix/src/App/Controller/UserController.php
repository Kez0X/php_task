<?php

namespace App\Controller;

use App\Model\UserModel;

class UserController
{
    public function signin(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $model = new UserModel();
            $user = $model->getUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                header('Location: index.php?page=home');
                exit;
            } else {
                $error = "Email ou mot de passe incorrect";
            }
        }

        require __DIR__ . '/../View/login.php';
    }

    public function signup(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm = $_POST['confirm_password'] ?? '';

            if ($password === $confirm) {
                $model = new UserModel();
                if ($model->createUser($email, $password)) {
                    header('Location: index.php?page=signin');
                    exit;
                } else {
                    $error = "Erreur lors de la création du compte";
                }
            } else {
                $error = "Les mots de passe ne correspondent pas";
            }
        }

        require __DIR__ . '/../View/register.php';
    }

    public function signout(): void
    {
        session_destroy();
        header('Location: index.php?page=signin');
        exit;
    }
}
