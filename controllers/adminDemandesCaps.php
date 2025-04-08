<?php
require_once 'models/playerModel.php';
require_once 'src/class/player.php';

session_Start();
if(!isset($_SESSION['idJoueur'])){
    redirect('/connection');
}

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$playerModel = new PlayerModel($pdo);

$idJoueur = $_SESSION['idJoueur'];
$player = $playerModel->getPlayerById($idJoueur);

if(!$player || !$player->isAdmin){
    redirect('/index');
}


require 'views/adminDemandesCaps.php';

