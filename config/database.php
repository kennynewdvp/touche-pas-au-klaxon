<?php
// config/database.php

function getConnexion() {
    $host = 'localhost';
    $dbname = 'touche_pas_au_klaxon';
    $user = 'root';
    $pass = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $pdo;
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données.");
    }
}
?>