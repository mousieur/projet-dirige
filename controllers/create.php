<?php
require_once 'models/playerModel.php';
require_once 'src/class/database.php';
require_once 'src/router.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $alias = $_POST['alias'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];


    if(strlen($password) < 8 || strlen($confirm_password) < 8){
        $errors['password'] = "le mot de passe doit contenir au moins 8 caractères";
    }
    if ($password !== $confirm_password) {
        $errors['password'] = "Les mots de passe ne correspondent pas";
    }

    $db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
    $pdo = $db->getPDO();
    $playerModel = new playerModel($pdo);

    if($playerModel->getPlayerByAlias($alias)){
        $errors['alias'] = "un compte avec cet alias existe déjà";
    }
    if($playerModel->selectByEmail($email)){
        $errors['email'] = "un compte avec ce email existe déjà";
    }
    if(empty($errors)){
        $playerModel->createUser($alias, $nom, $prenom, $email, @$password);
        redirect('/connection?compteCree=true');
    }
}

require_once 'views/create.php';