<?php
require_once 'models/playerModel.php';

session_start();
if(!isset($_SESSION['idJoueur'])) {
    redirect('/connection');
}

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$playerModel = new PlayerModel($pdo);

if(isset($_POST['action'], $_POST['idJoueur'])) {
    $idJoueur = (int)$_POST['idJoueur'];
    $action = $_POST['action'];

    try {
        if ($action === 'accepter') {
            $playerModel->AcceptRequest($idJoueur);
            $_SESSION['message'] = "Demande acceptée avec succès.";
        } elseif ($action === 'refuser') {
            $playerModel->RefuseRequest($idJoueur);
            $_SESSION['message'] = "Demande refusée avec succès.";
        } else {
            $_SESSION['message'] = "Action non reconnue.";
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = "Erreur : " . $e->getMessage();
    }
}

redirect('/adminDemandesCaps');