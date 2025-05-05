<?php
require_once 'models/commentModel.php';
require_once 'src/class/database.php';
require_once 'src/router.php';

session_Start();
if (!isset($_SESSION['idJoueur'])) {
    redirect('/connection');
}

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$commentModel = new CommentModel($pdo);

$commentModel->createComment($_POST['idItem'],  $_SESSION['idJoueur'], $_POST['titre'], $_POST['description'], $_POST['rating']);
redirect('/details?idItem=' . $_POST['idItem']);