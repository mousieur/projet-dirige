<?php
require_once 'models/itemModel.php';
require_once 'src/class/item.php';
if (isset($_GET['val']) && isset($_GET['idItem'])) {
    $value = $_GET['val'];
    $idItem = $_GET['idItem'];

    if (!isset($_SESSION['idJoueur'])) {
        $_SESSION['idJoueur'] = 1;
    }

    $db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
    $pdo = $db->getPDO();

    $itemModel = new itemModel($pdo);
    $itemModel->updateItemInPanier($_SESSION['idJoueur'], $idItem, $value);
}