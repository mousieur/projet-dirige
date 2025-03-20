<?php
require_once 'models/playerModel.php';
require_once 'src/class/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $alias = $_POST['alias'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Vérifiez si les mots de passe correspondent
    if ($password !== $confirm_password) {
        die('Les mots de passe ne correspondent pas.');
    }

    // Hachez le mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Initialisation de la base de données
    $db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
    $pdo = $db->getPDO();

    // Créez une instance de PlayerModel et enregistrez l'utilisateur
    $playerModel = new playerModel($pdo);
    $playerModel->createUser($alias, $nom, $prenom, $email, $hashed_password);

    // Redirigez l'utilisateur vers la page de connexion ou une autre page
    header('Location: /connection.php');
    exit();
}