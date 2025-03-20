<?php
require_once 'models/itemModel.php';
require_once 'src/class/item.php';
require_once 'models/CommentModel.php';
require_once 'src/class/Comment.php';

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();

$itemModel = new itemModel($pdo);
$items = $itemModel->selectAll();

$commentModel = new CommentModel($pdo);

$search = "";
$arme = "";
$munition = "";
$armure = "";
$nourriture = "";
$medicament = "";

const ITEM_TYPES = ['Arme', 'Munition', 'Armure', 'Nourriture', 'Medicament'];

$itemCount = 0;
if(isset($_SESSION['idJoueur'])){
    $itemsForCount = $playerModel->getPanierById($_SESSION['idJoueur']);
    foreach ($itemsForCount as $iteme) {
        $itemCount += $iteme['quantite'];
    }
}

if (isPost()) {
    $currentItemTypes = getCurrentItemTypes();
    $search = getSanitizedSearch();

    if (!empty($currentItemTypes) && !empty($search)) {
        $currentItemsByItemTypes = $itemModel->getItemsByTypes($currentItemTypes);
        $currentItemsBySearch = $itemModel->searchItemsByName($search);
        $items = compareObjectsByID($currentItemsBySearch, $currentItemsByItemTypes);
    } elseif (!empty($currentItemTypes)) {
        $items = $itemModel->getItemsByTypes($currentItemTypes);
    } elseif (!empty($search)) {
        $items = $itemModel->searchItemsByName($search);
    }

    $arme = empty($_POST['Arme']) ? "" : "checked";
    $munition = empty($_POST['Munition']) ? "" : "checked";
    $armure = empty($_POST['Armure']) ? "" : "checked";
    $nourriture = empty($_POST['Nourriture']) ? "" : "checked";
    $medicament = empty($_POST['Medicament']) ? "" : "checked";
}

require 'views/index.php';

function getCurrentItemTypes(): array {
    $currentItemTypes = [];
    foreach (ITEM_TYPES as $itemType) {
        if (!empty($_POST[$itemType])) {
            $currentItemTypes[] = htmlspecialchars($itemType, ENT_QUOTES, 'UTF-8');
        }
    }
    return $currentItemTypes;
}

function getSanitizedSearch(): string {
    $search = isset($_POST['Search']) ? trim($_POST['Search']) : "";
    return htmlspecialchars($search, ENT_QUOTES, 'UTF-8');
}