<?php

class Item {
    public function __construct(
        public int $idItem,
        public string $nomItem,
        public int $quantiteStock,
        public string $itemType,
        public int $prixUnitaire,
        public float $poids,
        public int $utilite,
        public string $photo
    ) {}
}