<?php
require_once 'views/partials/head.php';
require_once 'views/partials/navigation.php';
?>

<main class="container mt-5">
    <h2>Demandes de caps en attente</h2>

    <!-- Display success or error message -->
    <?php if (!empty($message)): ?>
        <div class="alert <?= strpos($message, 'Erreur') === false ? 'alert-success' : 'alert-danger' ?>" role="alert">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>Joueur</th>
                <th>Montant demandé</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($demandes as $demande): ?>
                <tr>
                    <td><?= htmlspecialchars($demande['joueur']) ?></td>
                    <td><?= htmlspecialchars($demande['caps']) ?> caps</td>
                    <td><?= htmlspecialchars($demande['date']) ?></td>
                    <td>
                        <form method="post" action="/?action=traiterDemande">
                            <input type="hidden" name="idDemande" value="<?= $demande['id'] ?>">
                            <button type="submit" name="action" value="accepter"
                                class="btn btn-success btn-sm">Accepter</button>
                            <button type="submit" name="action" value="refuser"
                                class="btn btn-danger btn-sm">Refuser</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php require_once 'views/partials/footer.php'; ?>