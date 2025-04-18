<?php
require 'partials/head.php';
require 'partials/navigation.php';

if ($item) {
    $totalStars = 0;
    $nbComments = count($comments);
    foreach ($comments as $comment) {
        $totalStars += $comment->getEtoiles();
    }
    $averageStars = $nbComments > 0 ? floor($totalStars / $nbComments) : 0;
    ?>
    <!-- source du tempalte : https://templatemo.com/tm-559-zay-shop -->
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <img class="card-img img-fluid" src="public/img/<?php echo htmlspecialchars($item['image']); ?>"
                            alt="Card image cap" id="item-detail">
                    </div>
                </div>
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h2"><?php echo htmlspecialchars($item['nomItem']); ?></h1>
                            <p class="h3 py-2">$<?php echo htmlspecialchars($item['prixUnitaire']); ?></p>
                            <p class="py-2">
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $averageStars) {
                                        echo '<i class="fa fa-star text-warning"></i>';
                                    } else {
                                        echo '<i class="fa fa-star text-secondary"></i>';
                                    }
                                }
                                ?>
                                <span class="list-inline-item text-dark"> <?php echo htmlspecialchars($nbComments); ?>
                                    Comments</span>
                            </p>
                            <p class="h3 py-2">Quantity in stock: <?php echo htmlspecialchars($item['quantiteStock']); ?>
                            </p>
                            <h6>Description:</h6>
                            <p>Utility Value: <?php echo htmlspecialchars($item['utilite']); ?></p>

                            <?php if (is_array($itemDetails)): ?>
                                <?php if ($item['itemType'] == 'Arme'): ?>
                                    <p>Arme Type: <?php echo htmlspecialchars($itemDetails['typeArme']); ?></p>
                                    <p>Efficiency: <?php echo htmlspecialchars($itemDetails['efficacite']); ?></p>
                                    <p>Description: <?php echo htmlspecialchars($itemDetails['description']); ?></p>
                                <?php elseif ($item['itemType'] == 'Munition'): ?>
                                    <p>Caliber: <?php echo htmlspecialchars($itemDetails['calibre']); ?></p>
                                <?php elseif ($item['itemType'] == 'Armure'): ?>
                                    <p>Material Composition: <?php echo htmlspecialchars($itemDetails['composite']); ?></p>
                                    <p>Size: <?php echo htmlspecialchars($itemDetails['taille']); ?></p>
                                <?php elseif ($item['itemType'] == 'Nourriture'): ?>
                                    <p>Health: <?php echo htmlspecialchars($itemDetails['ptsVie']); ?> </p>
                                    <p>Caloric intake: <?php echo htmlspecialchars($itemDetails['apportCalorique']); ?></p>
                                    <p>Nutritional value: <?php echo htmlspecialchars($itemDetails['composantNutritif']); ?></p>
                                <?php elseif ($item['itemType'] == 'Medicament'): ?>
                                    <p>Effect: <?php echo htmlspecialchars($itemDetails['attendu']); ?></p>
                                    <p>Health: <?php echo htmlspecialchars($itemDetails['ptsVie']); ?> </p>
                                    <p>Duration: <?php echo htmlspecialchars($itemDetails['duree']); ?></p>
                                    <p>Undesirable: <?php echo htmlspecialchars($itemDetails['indesirable']); ?></p>
                                <?php endif; ?>
                            <?php endif; ?>

                            <form method="GET" action="/updateCart">
                                <input type="hidden" name="idItem" value="<?php echo htmlspecialchars($item['idItem']); ?>">
                                <input type="hidden" name="product-title"
                                    value="<?php echo htmlspecialchars($item['nomItem']); ?>">
                                <input type="hidden" id="quantiteStock"
                                    value="<?php echo htmlspecialchars($item['quantiteStock']); ?>">
                                <div class="row">
                                    <div class="col-auto">
                                        <ul class="list-inline pb-3">
                                            <li class="list-inline-item text-right">
                                                Quantity
                                                <input class="form-control" type="number" name="val" style="width: 80px;"
                                                    id="item-quantity" value="1">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row pb-3">
                                    <div class="col d-grid">
                                        <button type="submit" class="btn btn-success btn-lg" name="submit"
                                            value="addtocard">Ajouter au panier</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row">
                <!-- Left: Ratings Breakdown -->
                <div class="col-md-4">
                    <div class="mb-2">5 étoiles (60)
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: 60%"></div>
                        </div>
                    </div>
                    <div class="mb-2">4 étoiles (20)
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: 20%"></div>
                        </div>
                    </div>
                    <div class="mb-2">3 étoiles (10)
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: 10%"></div>
                        </div>
                    </div>
                    <div class="mb-2">2 étoiles (5)
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: 5%"></div>
                        </div>
                    </div>
                    <div class="mb-2">1 étoiles (5)
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: 5%"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">

                    <!-- début commentaire -->
                    <div class="comment-box mb-4">
                        <div class="d-flex align-items-center mb-1">
                            <i class="fas fa-user pfp-black fs-3"></i>
                            <strong>Jane Doe</strong>
                        </div>
                        <div class="mb-1">
                            <span class="text-warning"><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i></span>
                            <strong class="ms-2">Great Product</strong>
                        </div>
                        <div>
                            I've been using this product for a few weeks and it's been working perfectly. Highly recommend
                            it!
                        </div>
                    </div>
                    <!-- fin commentaire -->
                    <div class="comment-box mb-4">
                        <div class="d-flex align-items-center mb-1">
                            <i class="fas fa-user pfp-black fs-3"></i>
                            <strong>John Smith</strong>
                        </div>
                        <div class="mb-1">
                            <span class="text-warning"><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i></span>
                            <strong class="ms-2">Good but room for improvement</strong>
                        </div>
                        <div>
                            The product is decent but there are a few bugs that need to be ironed out. Still worth the money
                            though.
                        </div>
                    </div>

                    <!-- Add more comments as needed -->

                </div>
            </div>
        </div>

    </section>
    <?php
} else {
    echo "<p>Product ID is invalid ou not found</p>";
}

require 'partials/footer.php';