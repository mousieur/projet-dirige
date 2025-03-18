<?php
require_once 'models/itemModel.php';
require_once 'src/class/item.php';
if (isset($_GET['val']) && isset($_GET['idItem']) && isset($_SESSION['idJoueur'])){
    $value = $_GET['val'];
    $idItem = $_GET['idItem'];

    if (!isset($_SESSION['idJoueur'])) {
        $_SESSION['idJoueur'] = 1;
    }
    $idJoueur = $_SESSION['idJoueur'];

    $db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
    $pdo = $db->getPDO();

    $itemModel = new itemModel($pdo);
    $itemModel->updateItemInPanier($idJoueur, $idItem, $value);

    $playerModel = new playerModel($pdo);
    $player = $playerModel->selectById($idJoueur);
    $panier = $playerModel->getPanierById($idJoueur);
    $inventaire = $playerModel->getInventaireById($idJoueur);
    $total = 0;
    $poidsPanier = 0;
    $PoidsInventaire = 0;
    foreach ($panier as $item) {
        $total += $item['prixUnitaire'] * $item['quantite'];
        $poidsPanier += $item['poids'] * $item['quantite'];
    }
    foreach ($inventaire as $item) {
        $PoidsInventaire += $item['poids'] * $item['quantite'];
    }
    if($player->caps < $total){
        $_SESSION['messageCaps'] = "Vous n'avez pas assez de caps pour acheter ces items";
    }
    else{
        $_SESSION['messageCaps'] = "";
    }
    if($player->poidsMax < $poidsPanier + $PoidsInventaire){
        $_SESSION['messagePoids'] = "Vous avez dépassé le poids maximum de votre inventaire, vous perderiez de la dextérité";
    }
    else{
        $_SESSION['messagePoids'] = "";
    }
    redirect('/cart');
}