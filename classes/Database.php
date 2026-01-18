<?php //
class Database {
    private static ?PDO $db = null;

    public static function getConnection(): PDO {
        if (self::$db === null) {
            self::$db = new PDO(
                "mysql:host=localhost;dbname=zimmerreservierung;charset=utf8",
                "root",
                ""
            );
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$db;
    }
}
