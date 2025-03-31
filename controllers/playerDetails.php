<?php
sessionStart();
if(!isset($_SESSION['idJoueur'])){
    redirect('/connection');
}
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$playerModel = new playerModel($pdo);
$player = $playerModel->getPlayerById($_SESSION['idJoueur']);
$poidsInventaire = $playerModel->getPoidsInventaireById($_SESSION['idJoueur']);

require 'views/playerDetails.php';