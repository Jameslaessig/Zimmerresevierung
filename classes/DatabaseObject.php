<?php

interface DatabaseObject
{
    public function save(): bool;

    public static function getById(int $id);
    public static function getAll(): array;
    public  function delete():bool;

}