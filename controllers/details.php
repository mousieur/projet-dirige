<?php
require_once 'models/itemModel.php';
require_once 'models/commentModel.php';
require_once 'src/class/item.php';
require_once 'src/class/comment.php';

// Initialisation de la base de données
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();

// Récupération de l'ID de l'item depuis les paramètres GET
$item_id = isset($_GET['idItem']) ? $_GET['idItem'] : 0;

if ($item_id > 0) {
    // Récupération de l'item par son ID
    $itemModel = new ItemModel($pdo);
    $item = $itemModel->selectById($item_id);

    // Vérifiez si $item est un objet et transformez-le en tableau
    if (is_object($item)) {
        $item = [
            'idItem' => $item->getIdItems(),
            'nomItem' => $item->getNomItem(),
            'quantiteStock' => $item->getQuantiteStock(),
            'itemType' => $item->getItemType(),
            'prixUnitaire' => $item->getPrixUnitaire(),
            'poids' => $item->getPoids(),
            'utilite' => $item->getUtilite(),
            'image' => $item->getPhoto()
        ];
    }

    $itemDetails = $itemModel->getItemDetailsByType($item['idItem'], $item['itemType']);

    if (is_object($itemDetails)) {
        $itemDetails = (array) $itemDetails;
    }
    
    // Récupération des commentaires associés à l'item
    $commentModel = new CommentModel($pdo);
    $comments = $commentModel->getCommentsByIdItem($item_id);
} else {
    $item = null;
    $comments = [];
}

// Inclusion de la vue
require 'views/details.php';