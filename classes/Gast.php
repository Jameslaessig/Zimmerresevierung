<?php
require_once "Database.php";
require_once "DatabaseObject.php";

class Gast implements DatabaseObject {
    private ?int $id;
    private string $name;
    private string $email;
    private string $adresse;

    public function __construct($name, $email, $adresse, $id = null) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->adresse = $adresse;
    }

    public function validate(): bool {
        return !empty($this->name) && filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }

    public function save(): bool {
        $db = Database::getConnection();
        if ($this->id === null) {
            $stmt = $db->prepare(
                "INSERT INTO gast (name, email, adresse) VALUES (?, ?, ?)"
            );
            return $stmt->execute([$this->name, $this->email, $this->adresse]);
        }
        return false;
    }

    public static function getAll(): array {
        $db = Database::getConnection();
        return $db->query("SELECT * FROM gast")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById(int $id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM gast WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete(): bool {
        return false;
    }
}
