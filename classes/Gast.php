<?php
require_once "Database.php"; require_once "DatabaseObject.php";
class Zimmer implements DatabaseObject {
private ?int $id;
private string $nr;
private string $name;
private int $personen;
private float $preis;
private bool $balkon;

public function __construct(string $nr, string $name, int $personen, float $preis, bool $balkon, $id=null) {
$this->id = $id;
$this->nr = $nr;
$this->name = $name;
$this->personen = $personen;
$this->preis = $preis;
$this->balkon = $balkon;
}

public function save(): bool { return true; }
public static function getById(int $id) {}
public static function getAll(): array {
return Database::getConnection()
->query("SELECT * FROM zimmer")
->fetchAll(PDO::FETCH_ASSOC);
}
public function delete(): bool { return false; }
}
