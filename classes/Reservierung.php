<?php
require_once "Database.php";

class Reservierung {
    private ?int $id;
    private string $start;
    private string $ende;
    private Gast $gast;
    private Zimmer $zimmer;

    public function __construct($start, $ende, Gast $gast, Zimmer $zimmer, $id=null) {
        $this->id = $id;
        $this->start = $start;
        $this->ende = $ende;
        $this->gast = $gast;
        $this->zimmer = $zimmer;
    }

    public function save(): bool {
        $db = Database::getConnection();
        $stmt = $db->prepare(
            "INSERT INTO reservierung (gast_id, zimmer_id, start, ende)
             VALUES (?, ?, ?, ?)"
        );
        return $stmt->execute([
            $this->gast->getId(),
            $this->zimmer->getId(),
            $this->start,
            $this->ende
        ]);
    }

    public static function getAll(): array {
        $db = Database::getConnection();
        $sql = "
            SELECT r.*, g.name AS gastname, z.name AS zimmername
            FROM reservierung r
            JOIN gast g ON r.gast_id = g.id
            JOIN zimmer z ON r.zimmer_id = z.id
        ";
        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
