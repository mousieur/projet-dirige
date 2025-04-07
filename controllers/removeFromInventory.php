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
if(!isset($_GET['idItem']) || !isset($_GET['quantite']) || !isset($_GET['idJoueur'])){
    redirect('/');
}

if($_GET['mode'] == "sell"){
    $playerModel->sellItem($_GET['idJoueur'], $_GET['idItem'], $_GET['quantite']);
}
if($_GET['mode'] == "consume"){
    $playerModel->consumeItem($_GET['idJoueur'], $_GET['idItem'], $_GET['quantite']);
}
redirect('/inventory');