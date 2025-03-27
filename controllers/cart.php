<?php
require_once 'models/itemModel.php';
require_once 'src/class/item.php';

require_once 'models/playerModel.php';
require_once 'src/class/player.php';

sessionStart();
if (!isset($_SESSION['idJoueur'])) {
    redirect('/connection');
}
$idJoueur = $_SESSION['idJoueur'];

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();


$playerModel = new playerModel($pdo);
$player = $playerModel->getPlayerById($idJoueur);
$panier = $playerModel->getPanierById($idJoueur);
if($panier == null){
    $panier = [];
}
$total = 0;

foreach ($panier as $item) {
    $total += $item['prixUnitaire'] * $item['quantite'];
}
$poidsPanier = $playerModel->getPoidsPanierById($idJoueur);

$PoidsInventaire = $playerModel->getPoidsInventaireById($idJoueur);


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

$total = 0;
$poids = 0;
$count = 0;
foreach ($panier as $item) {
    $total += $item['prixUnitaire'] * $item['quantite'];
    $count += $item['quantite'];
    $poids += $item['poids'] * $item['quantite'];
}
view('cart', 
[
    'items' => $panier,
    'total' => $total,
    'poids' => $poids,
    'count' => $count
]);