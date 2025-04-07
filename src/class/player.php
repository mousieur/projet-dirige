<?php

class Player 
{
    public function __construct(
        public int $idJoueur,
        public string $alias,
        public string $nom,
        public string $prenom,
        public int $caps,
        public int $dexterite,
        public int $pointsDeVie,
        public float $poidsMax,
        public string $photo,
        public string $couleur,
        public string $email,
        public string $password,
        public bool $isAdmin,
    ) {}
}