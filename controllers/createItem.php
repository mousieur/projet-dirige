<?php

require_once 'models/itemModel.php';
require_once 'src/class/item.php';

session_start();
if (!isset($_SESSION['idJoueur'])) {
    redirect('/connection');
}

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$playerModel = new PlayerModel($pdo);

$idJoueur = $_SESSION['idJoueur'];
$player = $playerModel->getPlayerById($idJoueur);

if (!$player || !$player->isAdmin) {
    redirect('/index');
}

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

view(
    'createItem',
    [
        'message' => $message,
    ]
);