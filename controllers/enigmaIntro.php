<?php 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['f'])) {
        redirect('enigmaQuestions?diff=f');
    } elseif (isset($_POST['m'])) {
        redirect('enigmaQuestions?diff=m');
    } elseif (isset($_POST['d'])) {
        redirect('enigmaQuestions?diff=d');
    }
}

require 'views/enigmaIntro.php';