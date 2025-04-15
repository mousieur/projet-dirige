
<?php 
require 'partials/head.php';
require 'partials/navigation.php';
?>
<div class="container mt-5 mb-5">
  <div class="card shadow mx-auto" style="max-width: 500px;">
    <div class="card-body py-3 px-4">
    <?php if(isset($randomEnigme)) {?>
    <form method="post">
      <h5 class="card-title mb-3 text-center" id="<?=$randomEnigme->idEnigme?>"><?=$randomEnigme->question?></h5>
      <div class="d-grid gap-2">
        <?php foreach($randomEnigme->EnigmeAnswer as $answer) { ?>
          <?php if(!$showAnswer){ ?>
            <button type="submit" class="btn btn-outline-success w-100 mt-1" name="answer" value="<?=$answer->idResponse?>"><?=$answer->textResponse?></button>
          <?php } else { ?>
            <div type="button" class="btn <?php if($answer->isCorrect) { echo "btn-success w-100 mt-1"; } else { echo "btn-danger w-100 mt-1"; } ?>" disabled><?=$answer->textResponse?></div>
          <?php } } ?>
      </div>
    </form>
    <?php } ?>

      <div> <?=$text?> </div>

      <div class="d-flex justify-content-between mt-3">
        <a href="/enigmaIntro" class="btn btn-outline-secondary">Retourner aux options</a>
        <?php if(isset($randomEnigme)) {?><a href="/enigmaQuestions?diff=<?=$difficulty?>" class="btn btn-outline-secondary">Question suivante</a><?php } ?>
      </div>

    </div>
  </div>
</div>

<?php
require 'partials/footer.php';