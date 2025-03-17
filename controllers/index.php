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
$comments = $commentModel->selectAll();

require 'views/index.php';