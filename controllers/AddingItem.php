<?php
require_once 'models/itemModel.php';

session_start();
if (!isset($_SESSION['idJoueur'])) {
    redirect('/connection');
}

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$itemModel = new ItemModel($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomItem = trim($_POST['nomItem'] ?? '');
    $quantiteStock = intval($_POST['quantiteStock'] ?? 0);
    $itemType = trim($_POST['itemType'] ?? '');
    $prixUnitaire = intval($_POST['prixUnitaire'] ?? 0);
    $poids = floatval($_POST['poids'] ?? 0);
    $utilite = intval($_POST['utilite'] ?? 0);
    $photo = $_FILES['photo'] ?? null;

    $errors = [];

    if (empty($nomItem)) {
        $errors[] = "Le nom de l'item est requis.";
    }
    if ($quantiteStock <= 0) {
        $errors[] = "La quantité en stock doit être supérieure à 0.";
    }
    if (empty($itemType)) {
        $errors[] = "Le type d'item est requis.";
    }
    if ($prixUnitaire <= 0) {
        $errors[] = "Le prix unitaire doit être supérieur à 0.";
    }
    if ($poids <= 0) {
        $errors[] = "Le poids doit être supérieur à 0.";
    }
    if ($utilite <= 0) {
        $errors[] = "L'utilité doit être supérieure à 0.";
    }
    if (!$photo || $photo['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Une photo valide est requise.";
    }

    $dynamicFields = [];
    if ($itemType === 'Arme') {
        $dynamicFields['typeArme'] = trim($_POST['typeArme'] ?? '');
        $dynamicFields['efficacite'] = intval($_POST['efficacite'] ?? 0);
        $dynamicFields['description'] = trim($_POST['description'] ?? '');
    } elseif ($itemType === 'Munition') {
        $dynamicFields['calibre'] = trim($_POST['calibre'] ?? '');
    } elseif ($itemType === 'Armure') {
        $dynamicFields['composite'] = trim($_POST['composite'] ?? '');
        $dynamicFields['taille'] = trim($_POST['taille'] ?? '');
    } elseif ($itemType === 'Nourriture') {
        $dynamicFields['ptsVie'] = intval($_POST['ptsVie'] ?? 0);
        $dynamicFields['apportCalorique'] = intval($_POST['apportCalorique'] ?? 0);
        $dynamicFields['composantNutritif'] = trim($_POST['composantNutritif'] ?? '');
        $dynamicFields['mineralPrincipal'] = trim($_POST['mineralPrincipal'] ?? '');
    } elseif ($itemType === 'Medicament') {
        $dynamicFields['attendu'] = trim($_POST['attendu'] ?? '');
        $dynamicFields['ptsVie'] = intval($_POST['ptsVie'] ?? 0);
        $dynamicFields['duree'] = intval($_POST['duree'] ?? 0);
        $dynamicFields['indesirable'] = trim($_POST['indesirable'] ?? '');
    }

    if (empty($errors)) {
        $destinationPath = 'public/img/';
        $itemModel->moveUploadedPicture($destinationPath);

        $photoPath = $destinationPath . basename($photo['name']);
        $itemData = [
            'nomItem' => $nomItem,
            'quantiteStock' => $quantiteStock,
            'itemType' => $itemType,
            'prixUnitaire' => $prixUnitaire,
            'poids' => $poids,
            'utilite' => $utilite,
            'photo' => $photoPath,
            'dynamicFields' => $dynamicFields,
        ];

        try {
            $itemModel->CreateItem($itemData);
            $_SESSION['message'] = "L'item a été ajouté avec succès.";
        } catch (Exception $e) {
            $_SESSION['message'] = "Erreur lors de l'ajout de l'item : " . $e->getMessage();
        }
    } else {
        $_SESSION['message'] = implode('<br>', $errors);
    }
}

redirect('/createItem');