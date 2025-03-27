<?php
require_once 'models/itemModel.php';
require_once 'src/class/item.php';
sessionStart();
$_SESSION['messageQuantity'] = "";
if(!isset($_SESSION['idJoueur'])){
    redirect('/connection');
}
if (isset($_GET['val']) && isset($_GET['idItem'])){
    $value = $_GET['val'];
    $idItem = $_GET['idItem'];

    if (!isset($_SESSION['idJoueur'])) {
        $_SESSION['idJoueur'] = 1;
    }
    $idJoueur = $_SESSION['idJoueur'];

    $db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
    $pdo = $db->getPDO();

    $itemModel = new itemModel($pdo);

    $item = $itemModel->selectById($idItem);
    if($item->quantiteStock < $value){
        $itemModel->updateItemInPanier($idJoueur, $idItem, $item->quantiteStock);
        $_SESSION['messageQuantity'] = "*Il n'a pas assez d'items disponibles, la totalité des items disponibles ont été ajoutés à votre panier";
    }
    else{
        $itemModel->updateItemInPanier($idJoueur, $idItem, $value);
    }
}
redirect('/cart');