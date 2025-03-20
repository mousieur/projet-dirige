<?php 
    require 'partials/head.php';
    require 'partials/navigation.php';
?>
    <section class="bg-light">
        <div class="row">
            <div class="col-lg-2 bg-secondary text-dark border-end border-dark-subtle shadow p-4">
                <form method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="Search" placeholder="Nom" value="<?=$search?>">
                        <button class="btn btn-outline-light" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>

                    <div class="fw-bold mb-2">Catégorie</div>
                    
                    <div class="form-check">
                        <input type="checkbox" id="armes" name="Arme" class="form-check-input" <?=$arme?>>
                        <label for="armes" class="form-check-label">Armes</label>
                    </div>
                    
                    <div class="form-check">
                        <input type="checkbox" id="munitions" name="Munition" class="form-check-input" <?=$munition?>>
                        <label for="munitions" class="form-check-label">Munitions</label>
                    </div>
                    
                    <div class="form-check">
                        <input type="checkbox" id="armures" name="Armure" class="form-check-input" <?=$armure?>>
                        <label for="armures" class="form-check-label">Armures</label>
                    </div>
                    
                    <div class="form-check">
                        <input type="checkbox" id="nourritures" name="Nourriture" class="form-check-input" <?=$nourriture?>>
                        <label for="nourritures" class="form-check-label">Nourritures</label>
                    </div>
                    
                    <div class="form-check">
                        <input type="checkbox" id="medicaments" name="Medicament" class="form-check-input" <?=$medicament?>>
                        <label for="medicaments" class="form-check-label">Médicaments</label>
                    </div>
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
                if(!empty($items)) {
                    foreach ($items as $item) {
                        $totalStars = 0;

                    $comments = $commentModel->getCommentsByIdItem($item->idItem);
                    foreach ($comments as $comment)
                            $totalStars += $comment->etoiles;
                    
                    $avgStars = count($comments) > 0 ? floor($totalStars / count($comments)) : 0;
                    
                ?>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="/details?idItem=<?= $item->idItem ?>">
                            <img src="public/img/<?=$item->photo?>" class="card-img-top" alt="..." style="height: 400px;">
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
                            <p class="text-muted">Avis (<?=count($comments)?>)</p>
                        </div>
                    </div>
                </div>
                <?php }
                }?>
            </div>
        </div>
    </div>
    </section>

<?php
require 'partials/footer.php';