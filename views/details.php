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
                <div class="col-md-4">
                    <h4>Ratings</h4>
                    <?php
                    $ratingsBreakdown = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
                    foreach ($comments as $comment) {
                        $ratingsBreakdown[$comment->getEtoiles()]++;
                    }
                    foreach ($ratingsBreakdown as $stars => $count): ?>
                        <div class="mb-2"><?php echo $stars; ?> étoiles (<?php echo $count; ?>)
                            <div class="progress">
                                <div class="progress-bar bg-success"
                                    style="width: <?php echo ($nbComments > 0) ? ($count / $nbComments) * 100 : 0; ?>%"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="col-md-8">
                    <?php if ($canComment): ?>
                        <h3 class="fw-bold">Ajouter un commentaire</h3>
                        <!-- début commentaire -->
                        <form action="/createComment" method="POST">
                            <div class="comment-box mb-4">
                                <div class="mb-1 rating-stars"></div>
                                <input type="hidden" name="rating" id="rating-value" value="1">
                                <input type="hidden" name="idItem" value="<?php echo htmlspecialchars($item['idItem']); ?>">
                                <input type="hidden" name="idJoueur"
                                    value="<?php echo htmlspecialchars($_SESSION['idJoueur']); ?>">
                                <div>
                                    <input type="text" name="titre" class="form-control" placeholder="titre" required>
                                </div>
                                <div>
                                    <textarea name="description" class="form-control mb-2" placeholder="description"
                                        required></textarea>
                                </div>
                                <button type="submit" class="btn btn-success">Envoyer</button>
                            </div>
                        </form>
                    <?php endif ?>
                    <div class="comment-section mt-4">
                        <h3 class="fw-bold">Commentaires</h3>
                        <?php if (!empty($comments)): ?>
                            <?php foreach ($comments as $comment): ?>
                                <div class="comment-box mb-4">
                                    <div class="d-flex align-items-center mb-1">
                                        <i
                                            class="fa fa-fw <?php echo htmlspecialchars($comment->photo); ?> <?php echo htmlspecialchars($comment->couleur); ?> fs-3 me-2"></i>
                                        <strong><?php echo htmlspecialchars($comment->alias); ?></strong>
                                        <?php if (isset($isAdmin) && $isAdmin || $comment->idJoueur == $_SESSION["idJoueur"]): ?>
                                        <a class="btn fs-3"
                                            href="/deleteComment?idItem=<?= $comment->idItem ?>&idJoueur=<?= $comment->idJoueur ?>">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    <?php endif; ?>
                                    </div>
                                    <div class="mb-1">
                                        <span class="text-warning fs-4">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <i
                                                    class="fa fa-star <?php echo $i <= $comment->getEtoiles() ? 'text-warning' : 'text-secondary'; ?>"></i>
                                            <?php endfor; ?>
                                        </span>
                                        <strong class="ms-2 fs-3"><?php echo htmlspecialchars($comment->titre); ?></strong>
                                    </div>

                                    <div>
                                        <?php echo htmlspecialchars($comment->commentaire); ?>
                                    </div>

                                    <div class="text-muted">
                                        <small>Posté le : <?php echo htmlspecialchars($comment->date); ?></small>
                                    </div>

                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Aucun commentaire pour cet article.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <script>
        const starsContainer = document.querySelector('.rating-stars');
        const ratingInput = document.getElementById('rating-value');
        let currentRating = 0;

        for (let i = 1; i <= 5; i++) {
            const star = document.createElement('i');
            star.classList.add('fa', 'fa-star', 'text-secondary', 'me-1');
            star.dataset.value = i;
            if (i == 1) {
                star.classList.add('text-warning');
            }
            star.addEventListener('click', function () {
                currentRating = i;
                ratingInput.value = i;
                updateStars();
            });

            starsContainer.appendChild(star);
        }

        function updateStars() {
            const stars = starsContainer.querySelectorAll('i');
            stars.forEach(star => {
                const starValue = parseInt(star.dataset.value);
                star.classList.toggle('text-warning', starValue <= currentRating);
                star.classList.toggle('text-secondary', starValue > currentRating);
            });
        }
    </script>
    <?php
} else {
    echo "<p>Product ID is invalid ou not found</p>";
}

require 'partials/footer.php';
