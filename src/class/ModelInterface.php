<?php

interface ModelInterface
{
    public function selectAll() : null|array;
    public function selectById(int $id);
}