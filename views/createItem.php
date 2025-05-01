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
                        <h2 class="card-title text-center">Ajouter un Item</h2>

                        <?php if (!empty($message)): ?>
                            <div class="alert alert-info">
                                <?= htmlspecialchars($message) ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li><?= htmlspecialchars($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form action="/AddingItem" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nomItem" class="form-label">Nom de l'Item</label>
                                <input type="text" class="form-control" id="nomItem" name="nomItem" 
                                    value="<?= htmlspecialchars($_POST['nomItem'] ?? '') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="quantiteStock" class="form-label">Quantité en Stock</label>
                                <input type="number" class="form-control" id="quantiteStock" name="quantiteStock" 
                                    value="<?= htmlspecialchars($_POST['quantiteStock'] ?? '') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="itemType" class="form-label">Type d'Item</label>
                                <select class="form-control" id="itemType" name="itemType" required onchange="updateFormFields()">
                                    <option value="">-- Sélectionnez un type --</option>
                                    <option value="Arme">Arme</option>
                                    <option value="Munition">Munition</option>
                                    <option value="Armure">Armure</option>
                                    <option value="Nourriture">Nourriture</option>
                                    <option value="Medicament">Médicament</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="prixUnitaire" class="form-label">Prix Unitaire</label>
                                <input type="number" class="form-control" id="prixUnitaire" name="prixUnitaire" 
                                    value="<?= htmlspecialchars($_POST['prixUnitaire'] ?? '') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="poids" class="form-label">Poids</label>
                                <input type="number" step="0.01" class="form-control" id="poids" name="poids" 
                                    value="<?= htmlspecialchars($_POST['poids'] ?? '') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="utilite" class="form-label">Utilité</label>
                                <input type="number" class="form-control" id="utilite" name="utilite" 
                                    value="<?= htmlspecialchars($_POST['utilite'] ?? '') ?>" required>
                            </div>

                            <div id="dynamicFields"></div>

                            <div class="mb-3">
                                <label for="photo" class="form-label">Photo</label>
                                <input type="file" class="form-control" id="photo" name="photo" required>
                            </div>
                            <button type="submit" class="btn btn-success">Ajouter l'Item</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function updateFormFields() {
        const itemType = document.getElementById('itemType').value;
        const dynamicFields = document.getElementById('dynamicFields');
        dynamicFields.innerHTML = ''; 

        if (itemType === 'Arme') {
            dynamicFields.innerHTML = `
                <div class="mb-3">
                    <label for="typeArme" class="form-label">Type d'Arme</label>
                    <input type="text" class="form-control" id="typeArme" name="typeArme" required>
                </div>
                <div class="mb-3">
                    <label for="efficacite" class="form-label">Efficacité</label>
                    <input type="number" class="form-control" id="efficacite" name="efficacite" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" required></textarea>
                </div>
            `;
        } else if (itemType === 'Munition') {
            dynamicFields.innerHTML = `
                <div class="mb-3">
                    <label for="calibre" class="form-label">Calibre</label>
                    <input type="text" class="form-control" id="calibre" name="calibre" required>
                </div>
            `;
        } else if (itemType === 'Armure') {
            dynamicFields.innerHTML = `
                <div class="mb-3">
                    <label for="composite" class="form-label">Composition</label>
                    <input type="text" class="form-control" id="composite" name="composite" required>
                </div>
                <div class="mb-3">
                    <label for="taille" class="form-label">Taille</label>
                    <input type="text" class="form-control" id="taille" name="taille" required>
                </div>
            `;
        } else if (itemType === 'Nourriture') {
            dynamicFields.innerHTML = `
                <div class="mb-3">
                    <label for="ptsVie" class="form-label">Points de Vie</label>
                    <input type="number" class="form-control" id="ptsVie" name="ptsVie" required>
                </div>
                <div class="mb-3">
                    <label for="apportCalorique" class="form-label">Apport Calorique</label>
                    <input type="number" class="form-control" id="apportCalorique" name="apportCalorique" required>
                </div>
                <div class="mb-3">
                    <label for="composantNutritif" class="form-label">Composant Nutritif</label>
                    <input type="text" class="form-control" id="composantNutritif" name="composantNutritif" required>
                </div>
                <div class="mb-3">
                    <label for="mineralPrincipal" class="form-label">Minéral Principal</label>
                    <input type="text" class="form-control" id="mineralPrincipal" name="mineralPrincipal" required>
                </div>
            `;
        } else if (itemType === 'Medicament') {
            dynamicFields.innerHTML = `
                <div class="mb-3">
                    <label for="attendu" class="form-label">Effet Attendu</label>
                    <input type="text" class="form-control" id="attendu" name="attendu" required>
                </div>
                <div class="mb-3">
                    <label for="ptsVie" class="form-label">Points de Vie</label>
                    <input type="number" class="form-control" id="ptsVie" name="ptsVie" required>
                </div>
                <div class="mb-3">
                    <label for="duree" class="form-label">Durée</label>
                    <input type="number" class="form-control" id="duree" name="duree" required>
                </div>
                <div class="mb-3">
                    <label for="indesirable" class="form-label">Effets Indésirables</label>
                    <textarea class="form-control" id="indesirable" name="indesirable" required></textarea>
                </div>
            `;
        }
    }
</script>

<?php
require 'partials/footer.php';
?>