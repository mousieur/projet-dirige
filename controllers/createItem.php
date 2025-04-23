<?php

require_once 'models/itemModel.php';
require_once 'src/class/item.php';

session_start();
if (!isset($_SESSION['idJoueur'])) {
    redirect('/connection');
}

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$playerModel = new PlayerModel($pdo);
$itemModel = new ItemModel($pdo); // Instanciation du modèle ItemModel

$idJoueur = $_SESSION['idJoueur'];
$player = $playerModel->getPlayerById($idJoueur);

if (!$player || !$player->isAdmin) {
    redirect('/index');
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomItem = trim($_POST['nomItem'] ?? '');
    $quantiteStock = intval($_POST['quantiteStock'] ?? 0);
    $itemType = trim($_POST['itemType'] ?? '');
    $prixUnitaire = intval($_POST['prixUnitaire'] ?? 0);
    $poids = floatval($_POST['poids'] ?? 0);
    $photo = $_FILES['photo'] ?? null;

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
    if (!$photo || $photo['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Une photo valide est requise.";
    }

    $dynamicFields = [];
    if ($itemType === 'Arme') {
        $dynamicFields['typeArme'] = trim($_POST['typeArme'] ?? '');
        $dynamicFields['efficacite'] = intval($_POST['efficacite'] ?? 0);
        $dynamicFields['description'] = trim($_POST['description'] ?? '');

        if (empty($dynamicFields['typeArme'])) {
            $errors[] = "Le type d'arme est requis.";
        }
        if ($dynamicFields['efficacite'] <= 0) {
            $errors[] = "L'efficacité doit être supérieure à 0.";
        }
        if (empty($dynamicFields['description'])) {
            $errors[] = "La description est requise.";
        }
    } elseif ($itemType === 'Munition') {
        $dynamicFields['calibre'] = trim($_POST['calibre'] ?? '');
        if (empty($dynamicFields['calibre'])) {
            $errors[] = "Le calibre est requis.";
        }
    } elseif ($itemType === 'Armure') {
        $dynamicFields['composite'] = trim($_POST['composite'] ?? '');
        $dynamicFields['taille'] = trim($_POST['taille'] ?? '');

        if (empty($dynamicFields['composite'])) {
            $errors[] = "La composition est requise.";
        }
        if (empty($dynamicFields['taille'])) {
            $errors[] = "La taille est requise.";
        }
    } elseif ($itemType === 'Nourriture') {
        $dynamicFields['ptsVie'] = intval($_POST['ptsVie'] ?? 0);
        $dynamicFields['apportCalorique'] = intval($_POST['apportCalorique'] ?? 0);
        $dynamicFields['composantNutritif'] = trim($_POST['composantNutritif'] ?? '');

        if ($dynamicFields['ptsVie'] <= 0) {
            $errors[] = "Les points de vie doivent être supérieurs à 0.";
        }
        if ($dynamicFields['apportCalorique'] <= 0) {
            $errors[] = "L'apport calorique doit être supérieur à 0.";
        }
        if (empty($dynamicFields['composantNutritif'])) {
            $errors[] = "Le composant nutritif est requis.";
        }
    } elseif ($itemType === 'Medicament') {
        $dynamicFields['attendu'] = trim($_POST['attendu'] ?? '');
        $dynamicFields['ptsVie'] = intval($_POST['ptsVie'] ?? 0);
        $dynamicFields['duree'] = trim($_POST['duree'] ?? '');
        $dynamicFields['indesirable'] = trim($_POST['indesirable'] ?? '');

        if (empty($dynamicFields['attendu'])) {
            $errors[] = "L'effet attendu est requis.";
        }
        if ($dynamicFields['ptsVie'] <= 0) {
            $errors[] = "Les points de vie doivent être supérieurs à 0.";
        }
        if (empty($dynamicFields['duree'])) {
            $errors[] = "La durée est requise.";
        }
        if (empty($dynamicFields['indesirable'])) {
            $errors[] = "Les effets indésirables sont requis.";
        }
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
            'photo' => $photoPath,
            'dynamicFields' => $dynamicFields,
        ];

        // TODO: Insérer les données dans la base de données
        // Exemple : $itemModel->createItem($itemData);

        $_SESSION['success'] = "L'item a été ajouté avec succès.";
        redirect('/items');
    }
}

require 'views/createItem.php';