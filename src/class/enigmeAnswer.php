<?php
class EnigmeAnswer
{
    public function __construct(
        public int $idResponse,
        public string $textResponse,
        public bool $isCorrect,
    ) {}
}