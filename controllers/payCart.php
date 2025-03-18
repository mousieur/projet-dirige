<?php
if(!isset($_SESSION['idJoueur'])){
    require_once 'models/itemModel.php';
    require_once 'src/class/item.php';
    $pdo = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS)->getPDO();
    $playerModel = new PlayerModel($pdo);
    $playerModel->payCart($_SESSION['idJoueur']);
}
redirect('/');