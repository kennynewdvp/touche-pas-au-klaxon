<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une Agence</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 40px; color: #384050; background-color: #f1f8fc; }
        
        .form-box { background: white; padding: 40px; border-radius: 10px; max-width: 600px; margin: 0 auto; box-shadow: 0 4px 15px rgba(56, 64, 80, 0.1); border-top: 6px solid #0074c7; }
        h1 { font-weight: bold; margin-top: 0; margin-bottom: 30px; font-size: 24px; text-align: center; color: #00497c; }
        
        label { font-weight: bold; margin-bottom: 8px; color: #00497c; display: block; }
        
        input { width: 100%; padding: 10px; border: 1px solid #384050; border-radius: 6px; font-size: 15px; color: #384050; outline: none; transition: border-color 0.3s; box-sizing: border-box; margin-bottom: 20px;}
        input:focus { border-color: #0074c7; }
        
        .btn-submit { background-color: #0074c7; color: white; padding: 12px 25px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; transition: 0.3s; width: 100%; text-align: center; }
        .btn-submit:hover { background-color: #00497c; }
        
        a.btn-back-link { display: block; text-align: center; margin-top: 15px; color: #384050; text-decoration: none; font-weight: bold; }
        a.btn-back-link:hover { color: #cd2c2e; }
    </style>
</head>
<body>
    <div class="form-box">
        <h1>Modifier l'Agence</h1>
        <form action="?action=mettre_a_jour_agence" method="POST">
            <input type="hidden" name="id_agence" value="<?= htmlspecialchars($agence['id_agence']) ?>">
            <label for="nom_ville">Nom de la ville</label>
            <input type="text" id="nom_ville" name="nom_ville" value="<?= htmlspecialchars($agence['nom_ville']) ?>" required>
            <button type="submit" class="btn-submit">Mettre à jour</button>
            <a href="?action=admin_agences" class="btn-back-link">Annuler</a>
        </form>
    </div>
</body>
</html>