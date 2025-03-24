<?php
sessionStart();

if(isset($_SESSION['idJoueur'])){
    require_once 'models/playerModel.php';
    require_once 'src/class/player.php';
    $pdo = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS)->getPDO();
    $playerModel = new PlayerModel($pdo);
    $playerModel->payCart($_SESSION['idJoueur']);
}
redirect('/');