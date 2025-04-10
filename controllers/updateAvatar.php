<?php
require_once 'models/playerModel.php';
require_once 'src/class/player.php';

sessionStart();
if (!isset($_SESSION['idJoueur'])) {
    redirect('/connexion');
}

if(!isset($_POST['image']) || !isset($_POST['couleur'])){
    redirect('/');
}
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$playerModel = new playerModel($pdo);

$playerModel->updateAvatar($_SESSION['idJoueur'], $_POST['image'], $_POST['couleur']);
redirect('/');