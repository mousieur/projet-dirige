<?php 
    require 'partials/head.php';
    require 'partials/navigation.php';
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <div class="list-group" id="product-list">
                <?php foreach($items as $item): ?>
                    <div class="list-group-item d-flex align-items-center justify-content-between shadow p-3 mb-3">
                        <img src="public/img/img.jpg" class="rounded" alt="Product">
                        <h5 class="mb-0 flex-grow-1 ms-3"><?=$item['nomItem']?></h5>
                        <p class="mb-0">$<span class="product-price"><?=$item['prixUnitaire']?></span></p>
                        <div class="d-flex align-items-center mx-3">
                            <button class="btn btn-success btn-sm minus-btn"><i class="fas fa-minus"></i></button>
                                <span class="quantity mx-2"><?=$item['quantite']?></span>
                            <button class="btn btn-success btn-sm plus-btn"><i class="fas fa-plus"></i></button>
                        </div>
                        <button class="btn fs-3">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 shadow">
                <h4>Total (<?=$count?>): <?=$total?>$</h4>
                <h4>Poids : <?=$poids?>lbs</h4>
                <button class="btn btn-success w-100 mt-3">Payer</button>
            </div>
        </div>
    </div>
</div>