<?php 
    require 'partials/head.php';
    require 'partials/navigation.php';
?>
    <section class="bg-light">
        <div class="row">
            <div class="col-lg-2 bg-secondary text-dark border-end border-dark-subtle shadow p-4">
                <form method="post">
                    <div class="input-group mb-4">
                        <input type="text" class="form-control" placeholder="Nom">
                        <div class="input-group-append input-group-lg">
                          <button class="btn btn-outline-light" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                      </div>
                    <div class="fw-bold">Catégorie</div>
                    <input type="checkbox" name="armes" class="form-check-input">
                    <label for="armes">Armes</label><br>
                    <input type="checkbox" name="munitions" class="form-check-input">
                    <label for="munitions">Munitions</label><br>
                    <input type="checkbox" name="armures" class="form-check-input">
                    <label for="armures">Armures</label><br>
                    <input type="checkbox" name="nourritures" class="form-check-input">
                    <label for="nourritures">Nourritures</label><br>
                    <input type="checkbox" name="medicaments" class="form-check-input">
                    <label for="medicaments">Medicaments</label><br>
                </form>
            </div>
        <div class=" col-lg-9 p-5 m-auto">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Items disponibles</h1>
                </div>
            </div>
            <!-- source de départ du template d'un item : https://templatemo.com/tm-559-zay-shop -->
            <div class="row d-flex">
                <?php

                foreach ($items as $item) {

                    $nbComment = 0;
                    $totalStars = 0;
                    
                    foreach ($comments as $comment) {
                        if ($item->idItem == $comment->idItem) {
                            $nbComment++;
                            $totalStars += $comment->etoiles;
                        }
                    }
                    
                    $avgStars = $nbComment > 0 ? floor($totalStars / $nbComment) : 0;
                    
                ?>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="/details?idItem=<?= $item->idItem ?>">
                            <img src="public/img/<?=$item->photo?>" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li>
                                    <?php 
                                    for ($i = 1; $i <= 5; $i++)
                                        if($i <= $avgStars) 
                                            echo '<i class="text-warning fa fa-star"></i>';
                                        else
                                            echo '<i class="text-muted fa fa-star"></i>';
                                    ?>
                                </li>
                                <li class="text-muted text-right"><?= $item->prixUnitaire ?> $</li>
                            </ul>
                            <div class="d-flex justify-content-between">
                                <a href="/details" class="h2 text-decoration-none text-dark"><?= $item->nomItem ?></a>
                                <span class="text-light pt-2"><?= $item->poids ?> lbs</span>
                            </div>
                            <p class="card-text">
                            <?= $item->quantiteStock ?> disponibles
                            </p>
                            <p class="text-muted">Avis (<?=$nbComment?>)</p>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
    </section>

<?php
require 'partials/footer.php';