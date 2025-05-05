<?php
require_once 'models/enigmeModel.php';
require_once 'src/class/enigme.php';
require_once 'src/class/enigmeAnswer.php';
require_once 'src/class/enigmeNotSolved.php';

sessionStart();

if(!isset($_SESSION['idJoueur'])){
    redirect('/');
}
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$enigmeModel = new EnigmeModel($pdo);


if (!isset($_SESSION['enigmeNotSolved'])) {
    $_SESSION['enigmeNotSolved'] = $enigmeModel->getAllIdEnigmes();
}

$text = "";
$difficulty = $_GET['diff'] ?? null;
$showAnswer = false;
$changeAnswer = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $randomEnigme = $_SESSION['currentEnigme'];

    $chosenAnswer;
    foreach($randomEnigme->EnigmeAnswer as $answer) {
        if($answer->idResponse == $_POST['answer']) {
            $chosenAnswer = $answer;
            break;
        }
    }

    if($chosenAnswer->isCorrect) {
        $playerModel = new PlayerModel($pdo);
        $playerModel->GiveMoneyById($_SESSION['idJoueur'], $difficulty == 'd' ? 200 : ($difficulty == 'm' ? 100 : 50));
        if($randomEnigme->difficulty == 'd') {
            if(isset($_SESSION['hardStreak']))
                $_SESSION['hardStreak']++;
            else
                $_SESSION['hardStreak'] = 1;

            if($_SESSION['hardStreak'] % 3 == 0) {
                $playerModel->GiveMoneyById($_SESSION['idJoueur'], 1000);
                $_SESSION['hardStreak'] = 0;
                $text = "Vous avez gagné 1000$ pour avoir répondu correctement à " . $_SESSION['hardStreak'] . "énigmes difficiles consécutives !";
            }
        }
    } else {
        if(isset($_SESSION['hardStreak'])) {
            unset($_SESSION['hardStreak']);
        }
    }
    $showAnswer = true;
    $changeAnswer = false;
}

if ($difficulty && $changeAnswer) {
    if($difficulty != 'r') {
        $filteredEnigmes = array_filter($_SESSION['enigmeNotSolved'], function($enigme) use ($difficulty) {
            return $enigme->difficulty === $difficulty;
        });
    } else {
        $filteredEnigmes = $_SESSION['enigmeNotSolved'];
    }

    if (!empty($filteredEnigmes)) {
        $filteredEnigmes = array_values($filteredEnigmes);

        $randomIndex = random_int(0, count($filteredEnigmes) - 1);
        $selectedEnigme = $filteredEnigmes[$randomIndex];

        $randomEnigme = $enigmeModel->getEnigmeById($selectedEnigme->idEnigme);

        $_SESSION['currentEnigme'] = $randomEnigme;
        $_SESSION['enigmeNotSolved'] = array_filter($_SESSION['enigmeNotSolved'], function($e) use ($selectedEnigme) {
            return $e->idEnigme !== $selectedEnigme->idEnigme;
        });
    } else {
        $text = "Aucune enigme disponible pour cette difficulté.";
    }
} else if (!$difficulty) {
    redirect("/");
}
require 'views/enigmaQuestions.php';
