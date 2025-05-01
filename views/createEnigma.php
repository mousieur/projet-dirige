<?php
require 'partials/head.php';
require 'partials/navigation.php';
?>

<section class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="card mt-5 my-5">
                    <div class="card-body">
                        <h2 class="card-title text-center">Créer une Énigme</h2>
                        <form action="/createEnigma" method="POST">
                            <h4 class="text-success"><?=$_SESSION['messageCreateEnigme']?></h4>
                            <div class="mb-3">
                                <label class="form-label">Difficulté</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="difficulte" id="facile"
                                        value="f">
                                    <label class="form-check-label" for="facile">Facile</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="difficulte" id="moyen"
                                        value="m">
                                    <label class="form-check-label" for="moyen">Moyen</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="difficulte" id="difficile"
                                        value="d">
                                    <label class="form-check-label" for="difficile">Difficile</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="question" class="form-label">Question</label>
                                <input type="text" class="form-control" id="question" name="question"
                                    value="<?= htmlspecialchars($_POST['alias'] ?? '') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="BReponse" class="form-label">Bonne Réponse</label>
                                <input type="text" class="form-control" id="BReponse" name="BReponse"
                                    value="<?= htmlspecialchars($_POST['BReponse'] ?? '') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="MReponse1" class="form-label">Mauvaise Réponse #1</label>
                                <input type="text" class="form-control" id="MReponse1" name="MReponse1"
                                    value="<?= htmlspecialchars($_POST['MReponse1'] ?? '') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="MReponse2" class="form-label">Mauvaise Réponse #2</label>
                                <input type="text" class="form-control" id="MReponse2" name="MReponse2"
                                    value="<?= htmlspecialchars($_POST['MReponse2'] ?? '') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="MReponse3" class="form-label">Mauvaise Réponse #3</label>
                                <input type="text" class="form-control" id="MReponse3" name="MReponse3"
                                    value="<?= htmlspecialchars($_POST['MReponse3'] ?? '') ?>" required>

                            </div>
                            <button type="submit" class="btn btn-success">Créer une énigme</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require 'partials/footer.php';
?>