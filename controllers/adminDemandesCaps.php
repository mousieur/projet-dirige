<?php
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$playerModel = new PlayerModel($pdo);

$demandes = [
    ['id' => 1, 'joueur' => 'LinkMaster', 'caps' => 300, 'date' => '2025-04-07'],
    ['id' => 2, 'joueur' => 'ZeldaQueen', 'caps' => 150, 'date' => '2025-04-06'],
];

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

require 'views/adminDemandesCaps.php';

