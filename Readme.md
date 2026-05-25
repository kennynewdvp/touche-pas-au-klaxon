# 🚗 Touche pas au klaxon - Application de Covoiturage

Application web de gestion de covoiturage d'entreprise développée en **PHP** selon l'architecture **MVC (Modèle-Vue-Contrôleur)**. Ce projet permet aux collaborateurs d'une entreprise de proposer des trajets entre différentes agences.

## 🎯 Fonctionnalités Principales

### Espace Utilisateur
* Authentification sécurisée (sessions et hachage des mots de passe).
* Consultation des trajets disponibles (filtrage automatique des trajets passés ou complets).
* Création de trajets avec contrôles de cohérence (dates, agences de départ/arrivée).
* Modification et suppression de ses propres trajets.
* Visualisation des détails d'un trajet (coordonnées du conducteur) via fenêtre modale.

### Tableau de Bord Administrateur
* Consultation de la liste des collaborateurs inscrits.
* Gestion complète des agences (Création, Lecture, Modification, Suppression).
* Modération globale avec possibilité de supprimer n'importe quel trajet.
* Sécurité anti-suppression pour les agences liées à des trajets actifs.

## 🛠️ Technologies Utilisées
* **Backend :** PHP (vanilla)
* **Base de données :** MySQL via PDO
* **Frontend :** HTML5, CSS3 (Charte graphique sur mesure, sans framework)
* **Architecture :** MVC strict avec routeur centralisé

## 📂 Structure du Projet
* `app/controllers/` : Logique applicative et traitement des requêtes.
* `app/models/` : Requêtes SQL et communication avec la base de données.
* `app/views/` : Interfaces utilisateur (HTML/CSS).
* `config/` : Fichier de configuration PDO.
* `index.php` : Point d'entrée unique de l'application.

## 🚀 Installation Locale

1. Cloner le dépôt dans le répertoire de votre serveur local (ex: `htdocs` pour XAMPP).
2. Créer une base de données nommée `touche_pas_au_klaxon` dans phpMyAdmin.
3. Importer le script SQL du projet pour générer les tables.
4. Vérifier les identifiants de connexion dans le fichier `config/database.php`.
5. Lancer l'application via le navigateur (ex: `http://localhost/devoir-pratique/`).