
<?php 
require 'partials/head.php';
require 'partials/navigation.php';
?>
<div class="container mt-5 mb-5">
  <div class="card shadow mx-auto" style="max-width: 500px;">
    <div class="card-body py-3 px-4">
    <form method="post">
  <h5 class="card-title mb-3 text-center" id="<?=$randomEnigme->idEnigme?>"><?=$randomEnigme->question?></h5>
  <div class="d-grid gap-2">
    <?php 
    foreach($randomEnigme->EnigmeAnswer as $answer) {
    ?>
      <button type="submit" class="btn <?php if($showAnswer && !$answer->isCorrect) { echo "btn-outline-danger w-100 mt-1"; } else { echo "btn-outline-success w-100 mt-1"; } ?>" name="answer" value="<?=$answer->idResponse?>">
        <?=$answer->textResponse?>
      </button>
    <?php
    } ?>
  </div>
</form>
    </div>
  </div>
</div>

<?php
require 'partials/footer.php';