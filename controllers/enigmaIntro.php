<?php 
sessionStart();
if(!isset($_SESSION['idJoueur'])){
    redirect('/');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $difficulty = 'r';
    if (isset($_POST['f'])) {
        $difficulty = 'f';
    } elseif (isset($_POST['m'])) {
        $difficulty = 'm';
    } elseif (isset($_POST['d'])) {
        $difficulty = 'd';
    }
    
    redirect('enigmaQuestions?diff=' . $difficulty);
}

require 'views/enigmaIntro.php';