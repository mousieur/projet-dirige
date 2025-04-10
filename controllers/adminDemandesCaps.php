<?php
require_once 'models/playerModel.php';
require_once 'src/class/player.php';

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

$demandes = $playerModel->getAllRequest();
if ($demandes == null) {
    $demandes = [];
}

foreach ($demandes as &$demande) {
    $playerDetails = $playerModel->getPlayerById((int) $demande['idJoueur']);
    if ($playerDetails) {
        $demande['alias'] = $playerDetails->alias;
    } else {
        $demande['alias'] = "Inconnu";
    }
}

$totalDemandes = count($demandes);
view(
    'adminDemandesCaps',
    [
        'demandes' => $demandes,
        'totalDemandes' => $totalDemandes,
        'message' => $_SESSION['message'] ?? '',
    ]
);

unset($_SESSION['message']);

