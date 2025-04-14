<?php
require_once 'models/playerModel.php';
require_once 'src/class/database.php';
require_once 'src/router.php';

$errors = [];
$_POST['messageCreateEnigme'] = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $difficulte = $_POST['difficulte'];
    $question = $_POST['question'];
    $BReponse = $_POST['BReponse'];
    $MReponse1 = $_POST['MReponse1'];
    $MReponse2 = $_POST['MReponse2'];
    $MReponse3 = $_POST['MReponse3'];

    $db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
    $pdo = $db->getPDO();
    $playerModel = new playerModel($pdo);

    $playerModel->createEnigme($difficulte, $question, $BReponse, $MReponse1, $MReponse2, $MReponse3);
    $_POST['difficulte'] = "";
    $_POST['question'] = "";
    $_POST['BReponse'] = "";
    $_POST['MReponse1'] = "";
    $_POST['MReponse2'] = "";
    $_POST['MReponse3'] = "";
    $_POST['messageCreateEnigme'] = "Énigme créée";
}

require_once 'views/createEnigma.php';