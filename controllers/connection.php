<?php
sessionStart();
if(isset($_SESSION['idJoueur'])){
    redirect('/');
}

$accountCreated = isset($_GET['compteCree']) ? $_GET['compteCree'] : null;

$errorMessage['username'] = "";
$errorMessage['password'] = "";
$errorMessage['user'] = "";

$connection['username'] = "";
$connection['password'] = "";

if(isPost()) {
    if (!empty($_POST['username'])) {
        $connection['username'] = $_POST['username'];
        $errorMessage['username'] = "";
    } else {
        $errorMessage['username'] = "L'alias est obligatoire.";
    }

    if (!empty($_POST['password'])) {
        $connection['password'] = $_POST['password'];
        $errorMessage['password'] = "";
    } else {
        $errorMessage['password'] = "Le mot de passe est obligatoire.";
    }

    if (empty($errorMessage['password']) && empty($errorMessage['username'])) {
        $db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
        $pdo = $db->getPDO();
        $playerModel = new PlayerModel($pdo);

        if($playerModel->connectPlayer($connection['username'], $connection['password'])) {
            
            $player = $playerModel->getPlayerByAlias($connection['username']);
            sessionStart();
            $_SESSION['idJoueur'] = $player->idJoueur;
            redirect('/');
        } else {
            $errorMessage['user'] = "Le courriel ou le mot de passe est invalide";
        }
    }
}

require 'views/connection.php';