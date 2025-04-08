<?php
require 'partials/head.php';
require 'partials/navigation.php';
?>
<section class="bg-light py-5">
    <div class="container">
        <div class="card mx-auto shadow-lg" style="max-width: 70%;">
            <div class="card-header bg-success text-white text-center">
                <h2 class="mb-0">Player Details</h2>
            </div>
            <div class="card-body">
                <div class="pb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="fs-5 fw-bold">Alias:</div>
                        <span class="fs-5"><?= $player->alias ?></span>
                    </div>
                </div>
                <div class="pb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="fs-5 fw-bold">Prenom:</div>
                        <span class="fs-5"><?= $player->prenom ?></span>
                    </div>
                </div>
                <div class="pb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="fs-5 fw-bold">Nom:</div>
                        <span class="fs-5"><?= $player->nom ?></span>
                    </div>
                </div>
                <div class="pb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="fs-5 fw-bold">Email:</div>
                        <span class="fs-5"><?= $player->email ?></span>
                    </div>
                </div>
                <div class="pb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="fs-5 fw-bold">Solde:</div>
                        <div class="d-flex align-items-center ms-auto">
                            <span class="text-success me-3"><?= $_SESSION['messageRequest'] ?></span>
                            <form action="/requestCaps" class="d-inline me-3">
                                <button type="submit" class="btn btn-success" <?= $disable ? 'disabled' : '' ?>>Demander des caps</button>
                            </form>
                            <span class="fs-5"><?= $player->caps ?> caps</span>
                        </div>
                    </div>
                </div>
                <div class="pb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="fs-5 fw-bold">Points de vie:</div>
                        <span class="fs-5"><?= $player->pointsDeVie ?>pv</span>
                    </div>
                </div>
                <div class="pb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="fs-5 fw-bold">Dextérité:</div>
                        <span class="fs-5"><?= $player->dexterite ?></span>
                    </div>
                </div>
                <div class="pb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="fs-5 fw-bold">Poids:</div>
                        <span class="fs-5"><?= $poidsInventaire ?> / <?= $player->poidsMax ?>lbs</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
require 'partials/footer.php';
?>