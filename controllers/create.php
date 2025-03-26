<?php
require_once 'models/playerModel.php';
require_once 'src/class/database.php';
require_once 'src/router.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $alias = $_POST['alias'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Vérifiez si les mots de passe correspondent
    //Ajouter restriction sur le lenght des mots de passe
    if ($password !== $confirm_password || strlen($password) < 8) {
        die('Les mots de passe ne correspondent pas.');
    }

    // Initialisation de la base de données
    $db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
    $pdo = $db->getPDO();

    // Créez une instance de PlayerModel et enregistrez l'utilisateur
    $playerModel = new playerModel($pdo);

    if($playerModel->getPlayerByAlias($alias)){
        die('Un compte avec cet alias existe déjà.');
    }
    $playerModel->createUser($alias, $nom, $prenom, $email, @$password);

    // Redirigez l'utilisateur vers la page de connexion ou une autre page
    redirect('/connection?compteCree=true');
}

require_once 'views/create.php';