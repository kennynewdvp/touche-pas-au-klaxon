<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le trajet</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 40px; color: #384050; background-color: #f1f8fc; }
        
        .form-box { background: white; padding: 40px; border-radius: 10px; max-width: 600px; margin: 0 auto; box-shadow: 0 4px 15px rgba(56, 64, 80, 0.1); border-top: 6px solid #0074c7; }
        h1 { font-weight: bold; margin-top: 0; margin-bottom: 30px; font-size: 24px; text-align: center; color: #00497c; }
        
        .row { display: flex; gap: 20px; margin-bottom: 20px; }
        .form-group { flex: 1; display: flex; flex-direction: column; }
        label { font-weight: bold; margin-bottom: 8px; color: #00497c; }
        
        input, select { padding: 10px; border: 1px solid #384050; border-radius: 6px; font-size: 15px; color: #384050; outline: none; transition: border-color 0.3s; }
        input:focus, select:focus { border-color: #0074c7; }
        
        .btn-container { display: flex; justify-content: space-between; margin-top: 30px; align-items: center; }
        .btn-submit { background-color: #0074c7; color: white; padding: 12px 25px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; transition: 0.3s; width: auto; text-align: center; }
        .btn-submit:hover { background-color: #00497c; }
        
        .btn-back { background-color: #384050; color: white; padding: 12px 25px; border-radius: 6px; text-decoration: none; font-weight: bold; transition: 0.3s; }
        .btn-back:hover { background-color: #cd2c2e; } 
    </style>
</head>
<body>
    <div class="form-box">
        <h1>Modifier le trajet</h1>
        <form action="?action=mettre_a_jour_trajet" method="POST">
            
            <input type="hidden" name="id_trajet" value="<?= htmlspecialchars($trajet['id_trajet']) ?>">

            <div class="row">
                <div class="form-group">
                    <label for="id_depart">Agence de départ</label>
                    <select name="id_depart" id="id_depart" required>
                        <?php foreach ($agences as $agence): ?>
                            <option value="<?= $agence['id_agence'] ?>" <?= ($agence['id_agence'] == $trajet['id_agence_depart']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($agence['nom_ville']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date_depart">Date/Heure de départ</label>
                    <input type="datetime-local" name="date_depart" id="date_depart" value="<?= date('Y-m-d\TH:i', strtotime($trajet['date_heure_depart'])) ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label for="id_arrivee">Agence d'arrivée</label>
                    <select name="id_arrivee" id="id_arrivee" required>
                        <?php foreach ($agences as $agence): ?>
                            <option value="<?= $agence['id_agence'] ?>" <?= ($agence['id_agence'] == $trajet['id_agence_arrivee']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($agence['nom_ville']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date_arrivee">Date/Heure d'arrivée</label>
                    <input type="datetime-local" name="date_arrivee" id="date_arrivee" value="<?= date('Y-m-d\TH:i', strtotime($trajet['date_heure_arrivee'])) ?>" required>
                </div>
            </div>

            <div class="row" style="max-width: 50%;">
                <div class="form-group">
                    <label for="places">Places disponibles</label>
                    <input type="number" name="places" id="places" min="1" value="<?= htmlspecialchars($trajet['places_disponibles']) ?>" required>
                </div>
            </div>

            <div class="btn-container">
                <a href="index.php" class="btn btn-back">Annuler</a>
                <button type="submit" class="btn btn-submit">Enregistrer les modifications</button>
            </div>
        </form>
    </div>
</body>
</html>