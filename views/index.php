
<?php
    $bd = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
    $pdo = $bd->getPDO();
?>
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
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="shop-single.html">
                            <img src="./assets/img/feature_prod_01.jpg" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                </li>
                                <li class="text-muted text-right">$240.00</li>
                            </ul>
                            <div class="d-flex justify-content-between">
                                <a href="shop-single.html" class="h2 text-decoration-none text-dark">Flesh light</a>
                                <span class="text-light pt-2">18 lbs</span>
                            </div>
                            <p class="card-text">
                                la lumière suce
                            </p>
                            <p class="text-muted">Avis (56)</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="shop-single.html">
                            <img src="./assets/img/feature_prod_02.jpg" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                </li>
                                <li class="text-muted text-right">$480.00</li>
                            </ul>
                            <div class="d-flex justify-content-between">
                                <a href="shop-single.html" class="h2 text-decoration-none text-dark">Bust down watch</a>
                                <span class="text-light pt-2">18 lbs</span>
                            </div>
                            <p class="card-text">
                                Full iced out Rolex Daytona
                            </p>
                            <p class="text-muted">Avis (5)</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="shop-single.html">
                            <img src="./assets/img/feature_prod_03.jpg" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                </li>
                                <li class="text-muted text-right">$360.00</li>
                            </ul>
                            <div class="d-flex justify-content-between">
                                <a href="shop-single.html" class="h2 text-decoration-none text-dark">Appareil photo</a>
                                <span class="text-light pt-2">18 lbs</span>
                            </div>
                            <p class="card-text">
                                Parfait pour prendre des photos de sa graine
                            </p>
                            <p class="text-muted">Avis (7)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- End Featured Product -->


    <!-- Start Footer -->
    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-left text-light">
                            fait par les G.A.R.S dans le cardre du cours de projet dirigé
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->

    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->
</body>

</html>
========
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
                          <button class="btn btn-outline-light" type="submit"><i class="fa fa-search"></i>button</button>
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
            <!-- source du template d'un item : https://templatemo.com/tm-559-zay-shop -->
            <div class="row">
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="shop-single.html">
                            <img src="./assets/img/feature_prod_01.jpg" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                </li>
                                <li class="text-muted text-right">$240.00</li>
                            </ul>
                            <a href="shop-single.html" class="h2 text-decoration-none text-dark">Flesh light</a>
                            <p class="card-text">
                                la lumière suce
                            </p>
                            <p class="text-muted">Avis (56)</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="shop-single.html">
                            <img src="./assets/img/feature_prod_02.jpg" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                </li>
                                <li class="text-muted text-right">$480.00</li>
                            </ul>
                            <a href="shop-single.html" class="h2 text-decoration-none text-dark">Bust down watch</a>
                            <p class="card-text">
                                Full iced out Rolex Daytona
                            </p>
                            <p class="text-muted">Avis (5)</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="shop-single.html">
                            <img src="./assets/img/feature_prod_03.jpg" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                </li>
                                <li class="text-muted text-right">$360.00</li>
                            </ul>
                            <a href="shop-single.html" class="h2 text-decoration-none text-dark">Appareil Photo</a>
                            <p class="card-text">
                                Parfait pour prendre des photos de sa graine
                            </p>
                            <p class="text-muted">Avis (7)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
<?php
require 'partials/footer.php';