<?php
require_once 'models/playerModel.php';
require_once 'src/class/player.php';

sessionStart();
if (!isset($_SESSION['idJoueur'])) {
    redirect('/');
}

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();


$playerModel = new playerModel($pdo);
$items = $playerModel->getInventaireById($_SESSION['idJoueur']);
if($items == null){
    $items = [];
}


view('inventory',
[
    'items' => $items    
]);

