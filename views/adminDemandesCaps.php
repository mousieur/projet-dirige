<?php
require_once 'views/partials/head.php';
require_once 'views/partials/navigation.php';
?>

<main class="container mt-5">
    <h2>Demandes de caps en attente</h2>

    <p>Total demandes : <?= htmlspecialchars($totalDemandes) ?></p>
    
    <?php if (!empty($message)): ?>
        <div class="alert <?= strpos($message, 'Erreur') === false ? 'alert-success' : 'alert-danger' ?>" role="alert">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>Joueur</th>
                <th>Solde</th>
                <th>Montant demandé</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($demandes)): ?>
                <tr>
                    <td colspan="3">Aucune demande en attente.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($demandes as $demande): ?>
                    <tr>
                        <td><?= htmlspecialchars($demande['alias'] ?? 'Inconnu') ?></td>
                        <td><?= htmlspecialchars($demande['solde'] ?? '0') ?></td>
                        <td><?= htmlspecialchars($demande['requestedCaps'] ?? '0') ?> Caps</td>
                        <td>
                            <form method="post" action="/processRequest">
                                <input type="hidden" name="idJoueur" value="<?= htmlspecialchars($demande['idJoueur'] ?? '') ?>">
                                <button type="submit" name="action" value="accepter" class="btn btn-success btn-sm">Accepter</button>
                                <button type="submit" name="action" value="refuser" class="btn btn-danger btn-sm">Refuser</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</main>

<?php require_once 'views/partials/footer.php'; ?>