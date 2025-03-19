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

    public function getIdItems(): int {
        return $this->idItem;
    }

    public function getNomItem(): string {
        return $this->nomItem;
    }

    public function getQuantiteStock(): int {
        return $this->quantiteStock;
    }

    public function getItemType(): string {
        return $this->itemType;
    }   

    public function getPrixUnitaire(): int {
        return $this->prixUnitaire;
    }

    public function getPoids(): float {
        return $this->poids;
    }

    public function getUtilite(): int {
        return $this->utilite;
    }

    public function getPhoto(): string {
        return $this->photo;
    }
}

