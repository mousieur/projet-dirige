<?php
require_once 'models/itemModel.php';
require_once 'src/class/item.php';

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();

$itemModel = new itemModel($pdo);
//$items = $itemModel->selectAll();

view('index', []);