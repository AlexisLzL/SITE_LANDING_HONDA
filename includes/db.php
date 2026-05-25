<?php
class Database {
    private $pdo;

    public function __construct() {
        try {
            // Vercel tiene un sistema de archivos de solo lectura, por lo que debemos usar /tmp
            $isVercel = getenv('VERCEL') || isset($_ENV['VERCEL']);
            $dbPath = $isVercel ? '/tmp/database.sqlite' : __DIR__ . '/database.sqlite';
            
            $this->pdo = new PDO('sqlite:' . $dbPath);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->createTable();
        } catch (PDOException $e) {
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }

    private function createTable() {
        $sql = "CREATE TABLE IF NOT EXISTS inscripciones (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nombre TEXT NOT NULL,
            email TEXT NOT NULL,
            telefono TEXT NOT NULL,
            modelo TEXT NOT NULL,
            mensaje TEXT,
            fecha DATETIME DEFAULT CURRENT_TIMESTAMP
        )";
        $this->pdo->exec($sql);
    }

    public function getPdo() {
        return $this->pdo;
    }
}
?>