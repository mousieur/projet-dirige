<?php
class Enigme
{
    public function __construct(
        public int $idEnigme,
        public string $question,
        public string $difficulty,
        public array $EnigmeAnswer = []
    ) {}
}