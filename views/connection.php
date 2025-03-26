<?php
require 'partials/head.php';
require 'partials/navigation.php';

if (isset($_GET['compteCree']) && $_GET['compteCree'] === 'true') {
    echo '<div class="alert alert-success">Votre compte a été créé avec succès. Vous pouvez maintenant vous connecter.</div>';
}
?>

<h1 class="display-5 fw-bold text-body-emphasis text-center">Connection</h1>
<div class="container text-justify ">
<?php if(isset($accountCreated)) {?>    
    <h3>Compte créé!</h3>
<?php } ?>
<form action="" method="POST" class="mx-auto my-5" style="max-width: 400px;">
    <div class="mb-3">
        <label for="username" class="form-label">Alias</label>
        <input type="text" class="form-control" id="alias" name="username" value="<?=$connection['username']?>">
        <span class="text-danger"><?=$errorMessage['username']?></span>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password" value="<?=$connection['password']?>">
        <span class="text-danger"><?=$errorMessage['password']?></span>
    </div>
    <div class="mb-3">
        <span class="text-danger"><?=$errorMessage['user']?></span>
    </div>
    <div class="footer">
        <input type="submit" class="btn btn-success" value="Authentifier">
        <a class="btn btn-secondary" href="/">Annuler</a>
    </div>
</form>
</div>

<?php
require 'partials/footer.php';
?>
