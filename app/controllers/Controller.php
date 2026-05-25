<?php
// app/controllers/Controller.php

require_once __DIR__ . '/../models/Model.php';

// --- GESTION DE L'ACCUEIL ---

function afficherAccueil($id_details = null) {
    $trajets = getTrajets();
    $details = null;
    
    if ($id_details != null) {
        $details = getTrajetDetails($id_details);
    }
    
    require __DIR__ . '/../views/listeView.php';
}

// --- GESTION DE L'AUTHENTIFICATION ---

function afficherConnexion() {
    require __DIR__ . '/../views/connexionView.php';
}

function traiterConnexion() {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $employe = verifierConnexion($email, $password);
        
        if ($employe) {
            $_SESSION['id_employe'] = $employe['id_employe'];
            $_SESSION['nom'] = $employe['nom'];
            $_SESSION['prenom'] = $employe['prenom'];
            $_SESSION['role'] = $employe['role']; 
            $_SESSION['telephone'] = $employe['telephone']; 
            $_SESSION['email'] = $employe['email'];         
            
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Email ou mot de passe incorrect !'); window.location.href='index.php?action=connexion';</script>";
        }
    }
}

function deconnexion() {
    session_destroy();
    header("Location: index.php");
    exit();
}

// --- GESTION DES TRAJETS ---

function afficherCreationTrajet() {
    if (!isset($_SESSION['id_employe'])) { header("Location: index.php"); exit(); }
    
    $agences = getAgences(); 
    require __DIR__ . '/../views/creerView.php';
}

function traiterCreationTrajet() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_depart = $_POST['id_depart'];
        $date_depart = $_POST['date_depart'];
        $id_arrivee = $_POST['id_arrivee'];
        $date_arrivee = $_POST['date_arrivee'];
        $places = $_POST['places'];
        $id_auteur = $_SESSION['id_employe'];

        if ($id_depart == $id_arrivee) {
            echo "<script>alert('L\'agence de départ et d\'arrivée doivent être différentes !'); window.history.back();</script>";
            exit();
        }
        
        if (strtotime($date_arrivee) <= strtotime($date_depart)) {
            echo "<script>alert('L\'heure d\'arrivée doit être après l\'heure de départ !'); window.history.back();</script>";
            exit();
        }

        if (ajouterTrajet($id_depart, $date_depart, $id_arrivee, $date_arrivee, $places, $id_auteur)) {
            $_SESSION['flash'] = "Le trajet a été créé avec succès !";
            header("Location: index.php");
            exit();
        }
    }
}

function traiterSuppressionTrajet() {
    if (!isset($_SESSION['id_employe']) || !isset($_GET['id'])) { header("Location: index.php"); exit(); }
    
    if (supprimerTrajet($_GET['id'])) {
        $_SESSION['flash'] = "Le trajet a été supprimé avec succès.";
    } else {
        $_SESSION['flash'] = "Erreur lors de la suppression du trajet.";
    }
    
    header("Location: index.php");
    exit();
}

function afficherModificationTrajet() {
    if (!isset($_SESSION['id_employe']) || !isset($_GET['id'])) { header("Location: index.php"); exit(); }
    
    $id_trajet = $_GET['id'];
    $trajet = getTrajetById($id_trajet);
    $agences = getAgences(); 
    
    // Vérification des droits de modification (auteur ou administrateur)
    if ($trajet['id_auteur'] != $_SESSION['id_employe'] && $_SESSION['role'] != 'admin') {
        header("Location: index.php"); exit();
    }
    
    require __DIR__ . '/../views/modifierView.php';
}

function traiterModificationTrajet() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_trajet'])) {
        $id_trajet = $_POST['id_trajet'];
        $id_depart = $_POST['id_depart'];
        $date_depart = $_POST['date_depart'];
        $id_arrivee = $_POST['id_arrivee'];
        $date_arrivee = $_POST['date_arrivee'];
        $places = $_POST['places'];

        if ($id_depart == $id_arrivee) {
            echo "<script>alert('L\'agence de départ et d\'arrivée doivent être différentes !'); window.history.back();</script>";
            exit();
        }
        
        if (strtotime($date_arrivee) <= strtotime($date_depart)) {
            echo "<script>alert('L\'heure d\'arrivée doit être après l\'heure de départ !'); window.history.back();</script>";
            exit();
        }

        if (modifierTrajet($id_trajet, $id_depart, $date_depart, $id_arrivee, $date_arrivee, $places)) {
            $_SESSION['flash'] = "Le trajet a été modifié avec succès !";
            header("Location: index.php");
            exit();
        }
    }
}

// --- GESTION ADMINISTRATEUR ---

function afficherAdminUsers() {
    if (!isset($_SESSION['id_employe']) || $_SESSION['role'] != 'admin') {
        header("Location: index.php");
        exit();
    }
    
    $employes = getEmployes();
    require __DIR__ . '/../views/adminUsersView.php';
}

function afficherAdminAgences() {
    if (!isset($_SESSION['id_employe']) || $_SESSION['role'] != 'admin') {
        header("Location: index.php"); exit();
    }
    
    $agences = getAgences();
    require __DIR__ . '/../views/adminAgencesView.php';
}

function traiterSuppressionAgence() {
    if (!isset($_SESSION['id_employe']) || $_SESSION['role'] != 'admin' || !isset($_GET['id'])) {
        header("Location: index.php"); exit();
    }
    
    if (supprimerAgence($_GET['id'])) {
        $_SESSION['flash'] = "L'agence a été supprimée avec succès.";
    } else {
        $_SESSION['flash'] = "Impossible de supprimer cette agence car elle est utilisée dans un ou plusieurs trajets.";
    }
    
    header("Location: index.php?action=admin_agences");
    exit();
}

function afficherCreationAgence() {
    if (!isset($_SESSION['id_employe']) || $_SESSION['role'] != 'admin') { header("Location: index.php"); exit(); }
    
    require __DIR__ . '/../views/creerAgenceView.php';
}

function traiterCreationAgence() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom_ville'])) {
        if (ajouterAgence($_POST['nom_ville'])) {
            $_SESSION['flash'] = "L'agence a été créée avec succès.";
        }
        
        header("Location: index.php?action=admin_agences");
        exit();
    }
}

function afficherModificationAgence() {
    if (!isset($_SESSION['id_employe']) || $_SESSION['role'] != 'admin' || !isset($_GET['id'])) { header("Location: index.php"); exit(); }
    
    $agence = getAgenceById($_GET['id']);
    require __DIR__ . '/../views/modifierAgenceView.php';
}

function traiterModificationAgence() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_agence']) && isset($_POST['nom_ville'])) {
        if (modifierAgence($_POST['id_agence'], $_POST['nom_ville'])) {
            $_SESSION['flash'] = "L'agence a été modifiée avec succès.";
        }
        
        header("Location: index.php?action=admin_agences");
        exit();
    }
}
?>