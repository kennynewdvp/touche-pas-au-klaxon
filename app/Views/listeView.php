<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Touche pas au klaxon</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 40px; color: #384050; background-color: #f1f8fc; }
        
        .header { display: flex; justify-content: space-between; align-items: center; border: 2px solid #00497c; border-radius: 15px; padding: 10px 30px; margin-bottom: 20px; background-color: white; }
        .header h1 { margin: 0; font-size: 20px; font-weight: bold; color: #00497c; }
        .header a { text-decoration: none; }
        .header-actions { display: flex; align-items: center; gap: 15px; font-weight: bold; }
        
        .btn-sombre { background-color: #384050; color: white; padding: 10px 20px; border-radius: 8px; font-weight: bold; text-decoration: none; transition: 0.3s; }
        .btn-sombre:hover { background-color: #00497c; }
        
        .btn-connexion { background-color: #0074c7; color: white; padding: 10px 20px; border-radius: 8px; font-weight: bold; text-decoration: none; transition: 0.3s; }
        .btn-connexion:hover { background-color: #00497c; }
        
        .flash-message { background-color: #82b864; color: white; padding: 15px 30px; border-radius: 10px; margin-bottom: 30px; font-size: 16px; font-weight: bold; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        
        h2 { font-weight: bold; margin-bottom: 20px; font-size: 22px; color: #00497c; }
        
        table { width: 100%; border-collapse: collapse; margin-bottom: 50px; text-align: center; background-color: white; box-shadow: 0 4px 10px rgba(56, 64, 80, 0.1); border-radius: 10px; overflow: hidden; }
        th, td { padding: 15px; border: 1px solid #d1d5db; }
        th { background-color: #00497c; color: white; font-weight: bold; }
        tr:nth-child(even) td { background-color: #f1f8fc; }
        
        footer { text-align: center; color: #384050; font-size: 14px; margin-top: 50px; font-weight: bold; }
        .action-icon { text-decoration: none; margin: 0 5px; font-size: 18px; }

        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(56, 64, 80, 0.7); display: flex; justify-content: center; align-items: center; }
        .modal-box { background: white; padding: 40px; border-radius: 10px; width: 100%; max-width: 500px; position: relative; border-top: 6px solid #0074c7; box-shadow: 0 10px 25px rgba(0,0,0,0.2); }
        .modal-close { position: absolute; top: 15px; right: 20px; text-decoration: none; color: #cd2c2e; font-size: 20px; font-weight: bold; transition: 0.3s; }
        .modal-box p { font-size: 16px; margin-bottom: 20px; }
        .modal-box strong { color: #00497c; }
        .btn-fermer { display: block; width: fit-content; background-color: #384050; color: white; padding: 10px 20px; text-decoration: none; border-radius: 8px; font-weight: bold; margin-left: auto; margin-top: 30px; transition: 0.3s; }
        .btn-fermer:hover { background-color: #cd2c2e; }
    </style>
</head>
<body>

    <div class="header">
        <h1><a href="index.php" style="color: inherit;">Touche pas au klaxon</a></h1>
        <div class="header-actions">
            <?php if (isset($_SESSION['id_employe'])): ?>
                <?php if ($_SESSION['role'] == 'admin'): ?>
                    <a href="?action=admin_users" class="btn-sombre">Utilisateurs</a>
                    <a href="?action=admin_agences" class="btn-sombre">Agences</a>
                    <a href="?action=admin_trajets" class="btn-sombre active">Trajets</a>
                <?php else: ?>
                    <a href="?action=creer" class="btn-sombre">Créer un trajet</a>
                <?php endif; ?>
                <span>Bonjour <?= htmlspecialchars($_SESSION['prenom'] . ' ' . $_SESSION['nom']) ?></span>
                <a href="?action=logout" class="btn-connexion">Déconnexion</a>
            <?php else: ?>
                <a href="?action=connexion" class="btn-connexion">Connexion</a>
            <?php endif; ?>
        </div>
    </div>

    <?php if (isset($_SESSION['flash'])): ?>
        <div class="flash-message">
            <?= htmlspecialchars($_SESSION['flash']) ?>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['id_employe'])): ?>
        <h2>Trajets proposés</h2>
    <?php else: ?>
        <h2>Pour obtenir plus d'informations sur un trajet, veuillez vous connecter</h2>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>Départ</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Destination</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Places</th>
                <?php if (isset($_SESSION['id_employe'])): ?>
                    <th style="background-color: #00497c;">Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($trajets)): ?>
                <?php foreach ($trajets as $trajet): 
                    $dateDepart = date("d/m/Y", strtotime($trajet['date_heure_depart']));
                    $heureDepart = date("H:i", strtotime($trajet['date_heure_depart']));
                    $dateArrivee = date("d/m/Y", strtotime($trajet['date_heure_arrivee']));
                    $heureArrivee = date("H:i", strtotime($trajet['date_heure_arrivee']));
                ?>
                <tr>
                    <td><?= htmlspecialchars($trajet['ville_depart']) ?></td>
                    <td><?= $dateDepart ?></td>
                    <td><?= $heureDepart ?></td>
                    <td><?= htmlspecialchars($trajet['ville_arrivee']) ?></td>
                    <td><?= $dateArrivee ?></td>
                    <td><?= $heureArrivee ?></td>
                    <td><?= htmlspecialchars($trajet['places_disponibles']) ?></td>
                    
                    <?php if (isset($_SESSION['id_employe'])): ?>
                        <td>
                            <a href="?action=voir&id=<?= $trajet['id_trajet'] ?>" class="action-icon">👁️</a>
                            
                            <?php if ($trajet['id_auteur'] == $_SESSION['id_employe'] || $_SESSION['role'] == 'admin'): ?>
                                <a href="?action=modifier&id=<?= $trajet['id_trajet'] ?>" class="action-icon">📝</a>
                                <a href="?action=supprimer&id=<?= $trajet['id_trajet'] ?>" class="action-icon" onclick="return confirm('Supprimer ce trajet ?')">🗑️</a>
                            <?php endif; ?>
                        </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="<?= isset($_SESSION['id_employe']) ? '8' : '7' ?>">Aucun trajet n'est disponible.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if (isset($details) && $details): ?>
    <div class="modal-overlay">
        <div class="modal-box">
            <a href="index.php" class="modal-close">X</a>
            <p>Auteur : <strong><?= htmlspecialchars($details['prenom'] . ' ' . $details['nom']) ?></strong></p>
            <p>Téléphone : <strong><?= htmlspecialchars($details['telephone']) ?></strong></p>
            <p>Email : <strong><?= htmlspecialchars($details['email']) ?></strong></p>
            <p>Nombre total de places : <?= htmlspecialchars($details['places_totales']) ?></p>
            <a href="index.php" class="btn-fermer">Fermer</a>
        </div>
    </div>
    <?php endif; ?>

    <footer>&copy; 2024 - CENEF - MVC PHP</footer>
</body>
</html>