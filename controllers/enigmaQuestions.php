<?php
require_once 'models/enigmeModel.php';
require_once 'src/class/enigme.php';
require_once 'src/class/enigmeAnswer.php';
require_once 'src/class/enigmeNotSolved.php';

sessionStart();

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$enigmeModel = new EnigmeModel($pdo);

if (isset($_SESSION['enigmeNotSolved'])) {
    $_SESSION['enigmeNotSolved'] = $enigmeModel->getAllIdEnigmes();
}

$difficulty = $_GET['diff'] ?? null;
$showAnswer = false;
$changeAnswer = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $chosenAnswer;
    foreach($randomEnigme->EnigmeAnswer as $answer) {
        if($answer->idReponse == $_POST['answer']) {
            $chosenAnswer = $answer;
            break;
        }
    }

    if($chosenAnswer->isCorrect) {
        //Add money
        if($randomEnigme->difficulty == 'f') {
            //AddDifficultyStreak
        }
    }
    $showAnswer = true;
    $changeAnswer = false;
}

if ($difficulty && $changeAnswer) {
    $filteredEnigmes = array_filter($_SESSION['enigmeNotSolved'], function($enigme) use ($difficulty) {
        return $enigme->difficulty === $difficulty;
    });

    if (!empty($filteredEnigmes)) {
        $filteredEnigmes = array_values($filteredEnigmes);

        $randomIndex = random_int(0, count($filteredEnigmes) - 1);
        $selectedEnigme = $filteredEnigmes[$randomIndex];

        $randomEnigme = $enigmeModel->getEnigmeById($selectedEnigme->idEnigme);

        $_SESSION['enigmeNotSolved'] = array_filter($_SESSION['enigmeNotSolved'], function($e) use ($selectedEnigme) {
            return $e->idEnigme !== $selectedEnigme->idEnigme;
        });
    } else {
        redirect("/enigmaIntro");
    }
} else if (!$difficulty) {
    redirect("/");
}

require 'views/enigmaQuestions.php';
