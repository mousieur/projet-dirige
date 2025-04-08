<?php

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$playerModel = new PlayerModel($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['idDemande'])) {
    $idDemande = (int) $_POST['idDemande'];
    $action = $_POST['action'];

    try {
        if ($action === 'accepter') {
            $playerModel->AcceptRequest($idDemande);
            $message = "Demande acceptée avec succès.";
            redirect('/adminDemandesCaps');
        } elseif ($action === 'refuser') {
            $playerModel->RefuseRequest($idDemande);
            $message = "Demande refusée avec succès.";
            redirect('/adminDemandesCaps');
        }
    } catch (PDOException $e) {
        $message = "Erreur : " . $e->getMessage();
    }
}