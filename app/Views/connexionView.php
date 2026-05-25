<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Touche pas au klaxon</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f1f8fc; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; color: #384050; }
        .login-box { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(56, 64, 80, 0.1); width: 100%; max-width: 400px; text-align: center; border-top: 6px solid #0074c7; }
        .login-box h1 { margin-top: 0; font-size: 24px; color: #00497c; font-weight: bold; }
        .form-group { margin-bottom: 20px; text-align: left; }
        label { display: block; margin-bottom: 5px; color: #00497c; font-weight: bold; }
        input[type="email"], input[type="password"] { width: 100%; padding: 10px; border: 1px solid #384050; border-radius: 5px; box-sizing: border-box; outline: none; }
        input:focus { border-color: #0074c7; }
        .btn-submit { width: 100%; background-color: #0074c7; color: white; padding: 12px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; margin-top: 10px; transition: 0.3s; }
        .btn-submit:hover { background-color: #00497c; }
        .back-link { display: block; margin-top: 20px; color: #384050; text-decoration: none; font-size: 14px; font-weight: bold; }
        .back-link:hover { color: #0074c7; }
    </style>
</head>
<body>

    <div class="login-box">
        <h1>Connexion</h1>
        <form action="?action=login" method="POST">
            <div class="form-group">
                <label for="email">Adresse Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn-submit">Se connecter</button>
        </form>
        <a href="index.php" class="back-link">← Retour à l'accueil</a>
    </div>

</body>
</html>