<?php
require_once 'models/itemModel.php';
require_once 'models/commentModel.php';
require_once 'src/class/item.php';
require_once 'src/class/comment.php';
sessionStart();

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$commentModel = new CommentModel($pdo);
$item_id = isset($_GET['idItem']) ? $_GET['idItem'] : 0;

if ($item_id > 0) {
    $itemModel = new ItemModel($pdo);
    $item = $itemModel->selectById($item_id);

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


    $comments = $commentModel->getCommentsByIdItem($item_id);

} else {
    $item = null;
    $comments = [];
}
$canComment = false;
if(isset($_SESSION['idJoueur'])){
    $playerModel = new playerModel($pdo);
    $inventory = $playerModel->getInventaireById($_SESSION['idJoueur']);
    if($inventory == null){
        $inventory = [];
    }
    $hasTheItem = false;
    foreach($inventory as $item){
        if($item_id == $item['idItem']){
            $hasTheItem = true;
            break;
        }
    }
    $hasCommented = false;
    $comments = $commentModel->selectAll();
    foreach($comments as $comment){
        if($comment->idItem == $item_id && $comment->idJoueur == $_SESSION['idJoueur']){
            $hasCommented = true;
            break;
        }
    }
    $canComment = $hasTheItem && !$hasCommented;
}

require 'views/details.php';