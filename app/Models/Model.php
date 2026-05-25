<?php
// app/models/Model.php

require_once __DIR__ . '/../../config/database.php';

// --- GESTION DES TRAJETS ---

function getTrajets() {
    $pdo = getConnexion();
    
    $sql = "SELECT 
                t.id_trajet,
                ad.nom_ville AS ville_depart,
                t.date_heure_depart,
                aa.nom_ville AS ville_arrivee,
                t.date_heure_arrivee,
                t.places_disponibles,
                t.id_auteur
            FROM trajet t
            JOIN agence ad ON t.id_agence_depart = ad.id_agence
            JOIN agence aa ON t.id_agence_arrivee = aa.id_agence
            WHERE t.date_heure_depart >= NOW() AND t.places_disponibles > 0
            ORDER BY t.date_heure_depart ASC";
            
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getTrajetDetails($id_trajet) {
    $pdo = getConnexion();
    
    $sql = "SELECT 
                e.nom, 
                e.prenom, 
                e.telephone, 
                e.email, 
                t.places_totales 
            FROM trajet t
            JOIN employe e ON t.id_auteur = e.id_employe
            WHERE t.id_trajet = :id";
            
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id_trajet]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getTrajetById($id_trajet) {
    $pdo = getConnexion();
    $sql = "SELECT * FROM trajet WHERE id_trajet = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id_trajet]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function ajouterTrajet($id_depart, $date_depart, $id_arrivee, $date_arrivee, $places, $id_auteur) {
    $pdo = getConnexion();
    $sql = "INSERT INTO trajet (id_agence_depart, date_heure_depart, id_agence_arrivee, date_heure_arrivee, places_disponibles, places_totales, id_auteur) 
            VALUES (:id_depart, :date_depart, :id_arrivee, :date_arrivee, :places, :places, :id_auteur)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        'id_depart'   => $id_depart,
        'date_depart' => $date_depart,
        'id_arrivee'  => $id_arrivee,
        'date_arrivee'=> $date_arrivee,
        'places'      => $places,
        'id_auteur'   => $id_auteur
    ]);
}

function modifierTrajet($id_trajet, $id_depart, $date_depart, $id_arrivee, $date_arrivee, $places) {
    $pdo = getConnexion();
    $sql = "UPDATE trajet SET 
                id_agence_depart = :id_depart, 
                date_heure_depart = :date_depart, 
                id_agence_arrivee = :id_arrivee, 
                date_heure_arrivee = :date_arrivee, 
                places_disponibles = :places, 
                places_totales = :places 
            WHERE id_trajet = :id_trajet";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        'id_depart'   => $id_depart,
        'date_depart' => $date_depart,
        'id_arrivee'  => $id_arrivee,
        'date_arrivee'=> $date_arrivee,
        'places'      => $places,
        'id_trajet'   => $id_trajet
    ]);
}

function supprimerTrajet($id_trajet) {
    $pdo = getConnexion();
    $sql = "DELETE FROM trajet WHERE id_trajet = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute(['id' => $id_trajet]);
}

// --- GESTION DE L'AUTHENTIFICATION ET DES UTILISATEURS ---

function verifierConnexion($email, $mot_de_passe) {
    $pdo = getConnexion();
    
    $sql = "SELECT * FROM employe WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $employe = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($employe && password_verify($mot_de_passe, $employe['mot_de_passe'])) {
        return $employe;
    }
    return false;
}

function getEmployes() {
    $pdo = getConnexion();
    $stmt = $pdo->query("SELECT id_employe, nom, prenom, email, telephone, role FROM employe ORDER BY nom ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// --- GESTION DES AGENCES ---

function getAgences() {
    $pdo = getConnexion();
    $stmt = $pdo->query("SELECT * FROM agence ORDER BY nom_ville ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAgenceById($id_agence) {
    $pdo = getConnexion();
    $sql = "SELECT * FROM agence WHERE id_agence = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id_agence]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function ajouterAgence($nom_ville) {
    $pdo = getConnexion();
    $sql = "INSERT INTO agence (nom_ville) VALUES (:nom_ville)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute(['nom_ville' => $nom_ville]);
}

function modifierAgence($id_agence, $nom_ville) {
    $pdo = getConnexion();
    $sql = "UPDATE agence SET nom_ville = :nom_ville WHERE id_agence = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute(['nom_ville' => $nom_ville, 'id' => $id_agence]);
}

function supprimerAgence($id_agence) {
    $pdo = getConnexion();
    $sql = "DELETE FROM agence WHERE id_agence = :id";
    $stmt = $pdo->prepare($sql);
    
    try {
        return $stmt->execute(['id' => $id_agence]);
    } catch (PDOException $e) {
        return false;
    }
}
?>