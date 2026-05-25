<?php
// app/Router.php

require_once __DIR__ . '/controllers/Controller.php';

function routerRequete() {
    if (isset($_GET['action'])) {
        
        // --- AUTHENTIFICATION ---
        if ($_GET['action'] == 'connexion') {
            afficherConnexion(); 
        } elseif ($_GET['action'] == 'login') {
            traiterConnexion();
        } elseif ($_GET['action'] == 'logout') {
            deconnexion();
            
        // --- GESTION DES TRAJETS ---
        } elseif ($_GET['action'] == 'voir' && isset($_GET['id'])) {
            afficherAccueil($_GET['id']);
        } elseif ($_GET['action'] == 'creer') {
            afficherCreationTrajet(); 
        } elseif ($_GET['action'] == 'enregistrer_trajet') {
            traiterCreationTrajet();  
        } elseif ($_GET['action'] == 'supprimer' && isset($_GET['id'])) {
            traiterSuppressionTrajet(); 
        } elseif ($_GET['action'] == 'modifier' && isset($_GET['id'])) {
            afficherModificationTrajet();
        } elseif ($_GET['action'] == 'mettre_a_jour_trajet') {
            traiterModificationTrajet();

        // --- TABLEAU DE BORD ADMINISTRATEUR ---
        } elseif ($_GET['action'] == 'admin_users') {
            afficherAdminUsers();
        } elseif ($_GET['action'] == 'admin_agences') {
            afficherAdminAgences();
        } elseif ($_GET['action'] == 'supprimer_agence' && isset($_GET['id'])) {
            traiterSuppressionAgence();
        } elseif ($_GET['action'] == 'creer_agence') {
            afficherCreationAgence();
        } elseif ($_GET['action'] == 'enregistrer_agence') {
            traiterCreationAgence();
        } elseif ($_GET['action'] == 'modifier_agence' && isset($_GET['id'])) {
            afficherModificationAgence();
        } elseif ($_GET['action'] == 'mettre_a_jour_agence') {
            traiterModificationAgence(); 
            
        } else {
            afficherAccueil();
        }

    } else {
        afficherAccueil();
    }
}
?>