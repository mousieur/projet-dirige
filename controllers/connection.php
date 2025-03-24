<?php


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
        $userModel = new PlayerModel($pdo);

        if($userModel->connectPlayer($connection['username'], $connection['password'])) {
            
            if(!empty($user)) {
                if($user->active === 0) {
                    redirect('/compteInactif');
                } else {
                    sessionStart();
                    $_SESSION['user'] = $user;
                    redirect('/');
                }

            }
        } else {
            $errorMessage['user'] = "Le courriel ou le mot de passe est invalide";
        }
    }
}

require 'views/connection.php';