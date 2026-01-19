<?php

interface DatabaseObject
{
    public function save(): bool;

    public static function getById( $id);
    public static function getAll(): array;
    public static function delete():bool;

}