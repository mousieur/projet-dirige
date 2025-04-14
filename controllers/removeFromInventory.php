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
$inventory = $playerModel->getInventaireById($_GET['idJoueur']);
if($inventory == null){
    $inventory = [];
}

if($_GET['mode'] == "sell"){
    foreach ($inventory as $item) {
        if($item['idItem'] == $_GET['idItem']){
            if($item['quantite'] > $_GET['quantite']){
                $playerModel->sellItem($_GET['idJoueur'], $_GET['idItem'], $_GET['quantite']);
            }
            else{
                if($item['type'] == "Nourriture" || $item['type'] == "Medicament"){
                    $playerModel->sellItem($_GET['idJoueur'], $_GET['idItem'], $item['quantite'] - 1);
                }
                else{
                    $playerModel->sellItem($_GET['idJoueur'], $_GET['idItem'], $item['quantite']);
                }
            }
        }
    }
}

if($_GET['mode'] == "consume"){
    foreach ($inventory as $item) {
        if($item['idItem'] == $_GET['idItem']){
            if($item['quantite'] > 1){
                if($item['quantite'] > $_GET['quantite']){
                    $playerModel->consumeItem($_GET['idJoueur'], $_GET['idItem'], $_GET['quantite']);
                }
                else{
                    $playerModel->consumeItem($_GET['idJoueur'], $_GET['idItem'], $item['quantite'] - 1);
                }
            }
        }
    }

}
redirect('/inventory');