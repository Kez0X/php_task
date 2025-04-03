<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/style.css">
    <title>Inscription</title>
</head>
<body>
    <h2>Inscription</h2>
    <form action="/signup" method="POST">
        <label>Email :</label>
        <input type="email" name="email" required>
        <br>
        <label>Mot de passe :</label>
        <input type="password" name="password" required>
        <br>
        <label>Confirmer le mot de passe :</label>
        <input type="password" name="confirm_password" required>
        <br>
        <button type="submit">S'inscrire</button>
    </form>
    <button onclick="window.location.href='/'">Se connecter</button>
</body>
</html>
