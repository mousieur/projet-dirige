<?php
require 'partials/head.php';
require 'partials/navigation.php';
?>
<div class="row text-center py-3">
    <div class="col-lg-6 m-auto mt-5">
        <h1 class="h1">Inventaire</h1>
    </div>
</div>
<div class="col-lg-9 p-5 m-auto">
    <div class="row d-flex">
        <?php foreach ($items as $item): ?>
            <div class="col-12 col-md-4 mb-4">
                <div class="card h-100">
                    <a href="/details?idItem=<?= $item['idItem'] ?>">
                        <img src="public/img/<?= $item['photo'] ?>" class="card-img-top" alt="..." style="height: 400px;">
                    </a>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <a href="/details?idItem=<?= $item['idItem'] ?>"
                                class="h2 text-decoration-none text-dark"><?= $item['nomItem'] ?></a>
                            <span class="text-light pt-2"><?= $item['poids'] ?> lbs</span>
                        </div>
                        <ul class="list-unstyled d-flex justify-content-between">
                            <li class="text-muted text-right">Prix de vente :<?= number_format($item['prixDeVente'], 2) ?>$</li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php
require 'partials/footer.php';
?>