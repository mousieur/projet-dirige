
<?php 
require 'partials/head.php';
require 'partials/navigation.php';
?>
<div class="container mt-5 mb-5">
  <div class="card shadow mx-auto" style="max-width: 500px;">
    <div class="card-body py-3 px-4">
      <h5 class="card-title mb-3 text-center">Choisissez la difficulté de l'énigme!</h5>
      <form method="post" class="d-grid gap-2">
            <input type="submit" id="f" name="f" class="btn btn-outline-success w-100 mt-1" value="Difficulté facile">
            <input type="submit" id="m" name="m" class="btn btn-outline-success w-100 mt-1" value="Difficulté moyenne">
            <input type="submit" id="d" name="d" class="btn btn-outline-success w-100 mt-1" value="Difficulté difficile">
      </form>
    </div>
  </div>
</div>
<?php
require 'partials/footer.php';