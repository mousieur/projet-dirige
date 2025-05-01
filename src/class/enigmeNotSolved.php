<?php

class EnigmeNotSolved {
    public function __construct(
        public int $idEnigme,
        public string $difficulty,
    ) {}
}