<?php
require_once 'models/playerModel.php';
require_once 'src/class/player.php';

sessionStart();
if (!isset($_SESSION['idJoueur'])) {
    redirect('/connection');
}

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();

$playerModel = new playerModel($pdo);
$player = $playerModel->getPlayerById($_SESSION['idJoueur']);
$playerModel->requestCaps($_SESSION['idJoueur']);
$_SESSION['messageRequest'] = "Votre demande de caps a été envoyée avec succès.";
redirect('/playerDetails');
