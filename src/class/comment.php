<?php 
class Commentaire
{
    public function __construct(
        readonly public int $idItem,
        readonly public int $idJoueur,
        public string $titre,
        public string $commentaire,
        public string $date,
        public int $etoiles,
        public ?string $photo = 'fa-user',
        public ?string $alias = 'Anonyme',
        public ?string $couleur = 'pfp-gray',
    ) {}

    public function getEtoiles(): int {
        return $this->etoiles;
    }
}