<?php
require_once  'models/commentModel.php';
require_once 'src/class/comment.php';

sessionStart();

if (!isset($_SESSION['idJoueur'])) {
    redirect('/connection'); 
}

if (isset($_GET['idItem'], $_GET['idJoueur'])) {
    $idItem = intval($_GET['idItem']);
    $idJoueur = intval($_GET['idJoueur']);
    error_log("idItem: $idItem, idJoueur: $idJoueur");

    $db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
    $pdo = $db->getPDO();
    $commentModel = new CommentModel($pdo);

    try {
        $commentModel->deleteComment($idItem, $idJoueur);
        $_SESSION['message'] = "Commentaire supprimé avec succès.";
    } catch (Exception $e) {
        $_SESSION['message'] = "Erreur lors de la suppression du commentaire : " . $e->getMessage();
    }
} else {
    $_SESSION['message'] = "Paramètres manquants pour supprimer le commentaire.";
}

redirect('/details?idItem=' . ($_GET['idItem'] ?? 0));