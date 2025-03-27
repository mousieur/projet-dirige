<?php
require 'partials/head.php';
require 'partials/navigation.php';
?>
<section class="bg-light py-5">
    <div class="container">
        <div class="card mx-auto shadow-lg" style="max-width: 60%;">
            <div class="card-header bg-success text-white text-center">
                <h2 class="mb-0">Player Details</h2>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="fs-5 fw-bold">Alias:</div>
                    <span class="fs-5"><?= $player->alias ?></span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="fs-5 fw-bold">Prenom:</div>
                    <span class="fs-5"><?= $player->prenom ?></span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="fs-5 fw-bold">Nom:</div>
                    <span class="fs-5"><?= $player->nom ?></span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="fs-5 fw-bold">Email:</div>
                    <span class="fs-5"><?= $player->email ?></span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="fs-5 fw-bold">Solde:</div>
                    <span class="fs-5"><?= $player->caps ?> caps</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="fs-5 fw-bold">Points de vie:</div>
                    <span class="fs-5"><?= $player->pointsDeVie ?>pv</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="fs-5 fw-bold">Dextérité:</div>
                    <span class="fs-5"><?= $player->dexterite ?></span>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
require 'partials/footer.php';
?>