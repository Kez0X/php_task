<?php
$user = $_SESSION['user'] ?? null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/style.css">
    <title>Gestion des tâches</title>
</head>
<body>
    <?php if ($user): ?>
        <h1>Bonjour, <?= htmlspecialchars($user['email']) ?> !</h1>

        <h2>Vos tâches :</h2>

        <!-- Formulaire pour ajouter une tâche -->
        <form action="index.php?page=task_new" method="POST">
            <label for="title">Ajouter une nouvelle tâche :</label>
            <input type="text" name="title" required>
            <button type="submit">Ajouter</button>
        </form>

        <ul>
            <?php foreach ($tasks as $task): ?>
                <li>
                    <strong><?= htmlspecialchars($task['title']) ?></strong> - 
                    <?= $task['completed'] ? 'Complétée' : 'Non complétée' ?>

                    <!-- Formulaire pour supprimer une tâche -->
                    <form action="index.php?page=task_delete" method="POST" style="display:inline;">
                        <input type="hidden" name="delete_task_id" value="<?= $task['id'] ?>">
                        <button type="submit">Supprimer</button>
                    </form>

                    <!-- Formulaire pour éditer une tâche -->
                    <form action="index.php?page=task_edit" method="POST" style="display:inline;">
                        <input type="hidden" name="edit_task_id" value="<?= $task['id'] ?>">
                        <input type="text" name="edit_title" value="<?= htmlspecialchars($task['title']) ?>" required>
                        <label>
                            Complétée :
                            <input type="checkbox" name="edit_completed" <?= $task['completed'] ? 'checked' : '' ?>>
                        </label>
                        <button type="submit">Modifier</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>

        <br>
        <a href="index.php?page=logout">Se déconnecter</a>

    <?php else: ?>
        <h2>Accès refusé</h2>
        <p><a href="index.php?page=signin">Veuillez vous connecter</a></p>
    <?php endif; ?>
</body>
</html>
