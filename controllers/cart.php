<?php
require_once 'models/itemModel.php';
require_once 'src/class/item.php';
sessionStart();
if (!isset($_SESSION['idJoueur'])) {
    $_SESSION['idJoueur'] = 1;
}
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();

$itemModel = new itemModel($pdo);
$items = $itemModel->getPanierById($_SESSION['idJoueur']);

$total = 0;
$poids = 0;
$count = 0;
foreach ($items as $item) {
    $total += $item['prixUnitaire'] * $item['quantite'];
    $count += $item['quantite'];
    $poids += $item['poids'] * $item['quantite'];
}
view('cart', 
[
    'items' => $items,
    'total' => $total,
    'poids' => $poids,
    'count' => $count
]);