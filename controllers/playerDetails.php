<?php
sessionStart();
if(!isset($_SESSION['idJoueur'])){
    redirect('/connection');
}
if(!isset($_SESSION['messageRequest'])){
    $_SESSION['messageRequest'] = "";
}
if(!isset($_SESSION['disableRequest'])){
    $_SESSION['disableRequest'] = false;
}

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$playerModel = new playerModel($pdo);
$player = $playerModel->getPlayerById($_SESSION['idJoueur']);
$poidsInventaire = $playerModel->getPoidsInventaireById($_SESSION['idJoueur']);
$requests = $playerModel->getAllRequest();
$disable = false;
if($requests == null){
    $requests = [];
}
foreach ($requests as $request) {
    if($request['idJoueur'] == $_SESSION['idJoueur']){
        $disable = true;
    }
}
if($player->requestCount == 3){
    $disable = true;
}
require 'views/playerDetails.php';