<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Agences</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 40px; color: #384050; background-color: #f1f8fc; }
        
        .header { display: flex; justify-content: space-between; align-items: center; border: 2px solid #00497c; border-radius: 15px; padding: 10px 30px; margin-bottom: 20px; background-color: white; }
        .header h1 { margin: 0; font-size: 20px; font-weight: bold; color: #00497c; }
        .header a { text-decoration: none; }
        .header-actions { display: flex; align-items: center; gap: 15px; font-weight: bold; }
        
        .btn-sombre { background-color: #384050; color: white; padding: 10px 20px; border-radius: 8px; font-weight: bold; text-decoration: none; transition: 0.3s; }
        .btn-sombre:hover { background-color: #00497c; }
        .btn-sombre.active { background-color: #00497c; }
        
        .btn-connexion { background-color: #0074c7; color: white; padding: 10px 20px; border-radius: 8px; font-weight: bold; text-decoration: none; transition: 0.3s; }
        .btn-connexion:hover { background-color: #00497c; }
        
        .flash-message { background-color: #82b864; color: white; padding: 15px 30px; border-radius: 10px; margin-bottom: 30px; font-size: 16px; font-weight: bold; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        
        .section-titre { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        h2 { font-weight: bold; margin-bottom: 20px; font-size: 22px; color: #00497c; }
        
        table { width: 100%; border-collapse: collapse; margin-bottom: 50px; text-align: center; background-color: white; box-shadow: 0 4px 10px rgba(56, 64, 80, 0.1); border-radius: 10px; overflow: hidden; }
        th, td { padding: 15px; border: 1px solid #d1d5db; }
        th { background-color: #00497c; color: white; font-weight: bold; }
        tr:nth-child(even) td { background-color: #f1f8fc; }
        
        .badge { background-color: #f1f8fc; padding: 5px 10px; border-radius: 5px; font-size: 14px; font-weight: bold; color: #00497c; }
        .badge.admin { background-color: #cd2c2e; color: white; }

        footer { text-align: center; color: #384050; font-size: 14px; margin-top: 50px; font-weight: bold; }
        .action-icon { text-decoration: none; margin: 0 5px; font-size: 18px; }
    </style>
</head>
<body>

    <div class="header">
        <h1><a href="index.php" style="color: inherit;">Touche pas au klaxon</a></h1>
        <div class="header-actions">
            <a href="?action=admin_users" class="btn-sombre">Utilisateurs</a>
            <a href="?action=admin_agences" class="btn-sombre active">Agences</a>
            <a href="index.php" class="btn-sombre">Trajets</a>
            <span>Bonjour <?= htmlspecialchars($_SESSION['prenom'] . ' ' . $_SESSION['nom']) ?></span>
            <a href="?action=logout" class="btn-connexion">Déconnexion</a>
        </div>
    </div>

    <?php if (isset($_SESSION['flash'])): ?>
        <div class="flash-message">
            <?= htmlspecialchars($_SESSION['flash']) ?>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <div class="section-titre">
        <h2>Liste des agences</h2>
        <a href="?action=creer_agence" class="btn-connexion">Créer une agence</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom de la ville</th>
                <th style="width: 100px; text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($agences as $agence): ?>
            <tr>
                <td><?= htmlspecialchars($agence['id_agence']) ?></td>
                <td><?= htmlspecialchars($agence['nom_ville']) ?></td>
                <td style="text-align: center;">
                    <a href="?action=modifier_agence&id=<?= $agence['id_agence'] ?>" class="action-icon">📝</a>
                    <a href="?action=supprimer_agence&id=<?= $agence['id_agence'] ?>" class="action-icon" onclick="return confirm('Attention : vous ne pouvez pas supprimer une agence liée à un trajet existant. Continuer ?')">🗑️</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>