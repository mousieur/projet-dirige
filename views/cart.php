<?php 
    require 'partials/head.php';
    require 'partials/navigation.php';
?>
<script>
    function callPHPFunction(value, idItem) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "updateCart?val=" + encodeURIComponent(value) + "&idItem=" + encodeURIComponent(idItem), true);
        xhr.send();
    }
</script>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <div class="list-group" id="product-list">
                <?php foreach($items as $item): ?>
                    <div class="list-group-item d-flex align-items-center justify-content-between shadow p-3 mb-3">
                        <img src="public/img/<?=$item["photo"]?>" class="rounded" alt="Product">
                        <h5 class="mb-0 flex-grow-1 ms-3"><?=$item['nomItem']?></h5>
                        <p class="mb-0">$<span class="product-price"><?=$item['prixUnitaire']?></span></p>
                        <input type="number" class="form-control" value="<?=$item['quantite']?>" style="width: 80px;" onchange="callPHPFunction(this.value, <?= $item['idItem'] ?>)">
                        <a class="btn fs-3" href="/updateCart?val=0&idItem=<?=$item['idItem']?>">
                            <i class="fas fa-trash"></i>
                        </a> 
                    </div>
                <?php endforeach;?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 shadow">
                <h4>Total (<?=$count?>): <?=$total?>$</h4>
                <h4>Poids : <?=$poids?>lbs</h4>
                <a class="btn btn-success w-100 mt-3" href="/payCart">Payer</a><br>
                <div>
                    <p class="text-danger"><?= $_SESSION['messageCaps'] ?></p>
                    <p class="text-danger"><?= $_SESSION['messagePoids'] ?></p>
                </div>
            </div>
        </div>
    </div>
</div>