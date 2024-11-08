<?php
// classes/Dbh.class.php

class Dbh {
    private $dbPath;

    public function __construct() {
        $this->dbPath = __DIR__ . '/../db/database.db';
    }

    protected function connect() {
        try {
            $dsn = 'sqlite:' . $this->dbPath;
            $pdo = new PDO($dsn);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            error_log("Database connection error: " . $e->getMessage());
            throw new Exception("Er is een fout opgetreden bij de verbinding met de database.");
        }
    }
}
