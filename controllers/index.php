<?php
require_once 'models/itemModel.php';
require_once 'src/class/item.php';
require_once 'models/CommentModel.php';
require_once 'src/class/Comment.php';

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();

$itemModel = new itemModel($pdo);
$items = $itemModel->selectAll();

$commentModel = new CommentModel($pdo);


if (isPost()) {

    if(!empty($_POST['search']))
        $items = $itemModel->searchItemsByName($_POST['search']);

    if(!empty($_POST['armes']))
        $items += $itemModel->getAllArmes();
    if(!empty($_POST['munitions']))
        $items += $itemModel->getAllMunitions();
    if(!empty($_POST['armures']))
        $items += $itemModel->getAllArmures();
    if(!empty($_POST['nourritures']))
        $items += $itemModel->getAllNourritures();
    if(!empty($_POST['medicaments']))
        $items += $itemModel->getAllMedicaments();
}

require 'views/index.php';