<?php
require_once 'models/playerModel.php';
require_once 'src/class/database.php';
require_once 'src/router.php';

session_Start();
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

$errors = [];
$_SESSION['messageCreateEnigme'] = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $difficulte = $_POST['difficulte'];
    $question = $_POST['question'];
    $BReponse = $_POST['BReponse'];
    $MReponse1 = $_POST['MReponse1'];
    $MReponse2 = $_POST['MReponse2'];
    $MReponse3 = $_POST['MReponse3'];

    $playerModel->createEnigme($difficulte, $question, $BReponse, $MReponse1, $MReponse2, $MReponse3);
    $_POST['difficulte'] = "";
    $_POST['question'] = "";
    $_POST['BReponse'] = "";
    $_POST['MReponse1'] = "";
    $_POST['MReponse2'] = "";
    $_POST['MReponse3'] = "";
    $_SESSION['messageCreateEnigme'] = "Énigme créée avec succès!";
}

require_once 'views/createEnigma.php';