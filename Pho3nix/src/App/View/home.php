<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>Accueil</title>
</head>
<body>
    <h1>Bonjour, <?= htmlspecialchars($user['email']) ?> !</h1>

    <h2>Vos tâches :</h2>
    <ul>
        <?php foreach ($tasks as $task): ?>
            <li><?= htmlspecialchars($task['title']) ?></li>
        <?php endforeach; ?>
    </ul>

    <?php
        if (isset($_SESSION['user'])) {
            echo "<a href='/logout'>Se déconnecter</a>";
        }
    ?>

</body>
</html>
