# php_task

Ce site sera un gestionnaire de tache en ligne avec un sytème de connexion et des tâches qu'on peut ajouter et enlver comme bon nous semble.

## Instructions SQL à la création de la base de données

```sql
CREATE DATABASE task_manager;

USE task_manager;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE tasks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    completed BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

## Création d'un utilisateur test

```sql
INSERT INTO users (email, password) 
VALUES ('test@example.com', '$2y$10$eImG8oWO1ol9p.xG/a3O/uWbA21r/EZixcFUp/89TFfl9x4czsx2e'); 
```

## Création de la base de donnée sur serveur

```bash
ssh utilisateur@mon-serveur.com
```

```bash
mysql -u root -p
```
Puis on peut le faire soit via phpadmin si disponible soit via les lignes de commandes en SQL

## Configurer l'accès à la BDD

Au choix directement via le model de Connexion, soit via un fichier database.php dans /config.

```php
$host = 'mon-serveur.com'; // Ou '127.0.0.1' si MySQL est en local sur le serveur
$dbname = 'task_manager';
$username = 'mon_user';
$password = 'mon_mot_de_passe';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
```
