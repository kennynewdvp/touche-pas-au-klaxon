<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer une Agence</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 40px; color: #384050; background-color: #f1f8fc; }
        
        .form-box { background: white; padding: 40px; border-radius: 10px; max-width: 600px; margin: 0 auto; box-shadow: 0 4px 15px rgba(56, 64, 80, 0.1); border-top: 6px solid #0074c7; }
        h1 { font-weight: bold; margin-top: 0; margin-bottom: 30px; font-size: 24px; text-align: center; color: #00497c; }
        
        .row { display: flex; gap: 20px; margin-bottom: 20px; }
        .form-group { flex: 1; display: flex; flex-direction: column; }
        label { font-weight: bold; margin-bottom: 8px; color: #00497c; }
        
        input, select { padding: 10px; border: 1px solid #384050; border-radius: 6px; font-size: 15px; color: #384050; outline: none; transition: border-color 0.3s; }
        input:focus, select:focus { border-color: #0074c7; }
        input[readonly] { background-color: #f1f8fc; color: #384050; cursor: not-allowed; border: 1px solid #d1d5db; }
        
        .btn-container { display: flex; justify-content: space-between; margin-top: 30px; align-items: center; }
        .btn-submit { background-color: #0074c7; color: white; padding: 12px 25px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; transition: 0.3s; width: 100%; text-align: center; }
        .btn-submit:hover { background-color: #00497c; }
        
        .btn-container .btn-submit { width: auto; }
        .btn-back { background-color: #384050; color: white; padding: 12px 25px; border-radius: 6px; text-decoration: none; font-weight: bold; transition: 0.3s; }
        .btn-back:hover { background-color: #cd2c2e; } 
        
        a.btn-back-link { display: block; text-align: center; margin-top: 15px; color: #384050; text-decoration: none; font-weight: bold; }
        a.btn-back-link:hover { color: #cd2c2e; }
    </style>
</head>
<body>

    <div class="form-box">
        <h1>Nouvelle Agence</h1>
        <form action="?action=enregistrer_agence" method="POST">
            <label for="nom_ville">Nom de la ville</label>
            <input type="text" id="nom_ville" name="nom_ville" required>
            <button type="submit" class="btn-submit">Enregistrer</button>
            <a href="?action=admin_agences" class="btn-back-link">Annuler</a>
        </form>
    </div>

</body>
</html>