<?php
require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/DatabaseObject.php";

class Zimmer implements DatabaseObject {
    private ?int $id;
    private string $nr;
    private string $name;
    private int $personen;
    private float $preis;
    private bool $balkon;

    public function __construct($nr, $name, $personen, $preis, $balkon, $id=null) {
        $this->id = $id;
        $this->nr = $nr;
        $this->name = $name;
        $this->personen = $personen;
        $this->preis = $preis;
        $this->balkon = $balkon;
    }

    public function save(): bool {
        return true; // CSV Import
    }

    public static function getAll(): array {
        return Database::getConnection()
            ->query("SELECT * FROM rooms")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById(int $id) {}
    public function delete(): bool { return false; }
}
