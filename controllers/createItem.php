<?php

require_once 'models/itemModel.php';
require_once 'src/class/item.php';

session_start();
if (!isset($_SESSION['idJoueur'])) {
    redirect('/connection');
}

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$itemModel = new ItemModel($pdo);
$playerModel = new PlayerModel($pdo);

$idJoueur = $_SESSION['idJoueur'];
$player = $playerModel->getPlayerById($idJoueur);

if (!$player || !$player->isAdmin) {
    redirect('/index');
}

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $photoFileName = $itemModel->moveUploadedPicture();

        $itemData = [
            'nomItem' => trim($_POST['nomItem']),
            'quantiteStock' => intval($_POST['quantiteStock']),
            'itemType' => trim($_POST['itemType']),
            'prixUnitaire' => intval($_POST['prixUnitaire']),
            'poids' => floatval($_POST['poids']),
            'utilite' => intval($_POST['utilite']),
            'photo' => $photoFileName, 
            'dynamicFields' => $_POST 
        ];
        
        $itemModel->CreateItem($itemData);

        $_SESSION['message'] = "L'item a été créé avec succès.";
    } catch (Exception $e) {
        $_SESSION['message'] = "Erreur : " . $e->getMessage();
    }

    redirect('/createItem');
}

view(
    'createItem',
    [
        'message' => $message,
    ]
);