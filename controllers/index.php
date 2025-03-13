<?php
require 'src/class/database.php';
require_once 'models/itemModel.php';

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();

$itemModel = new itemModel($pdo);
$items = $itemModel->selectAll();

require 'views/index.php';