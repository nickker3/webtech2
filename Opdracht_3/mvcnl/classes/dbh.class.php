<?php
// classes/Dbh.class.php

class Dbh {
    private $dbName = '../db/database.db';

    protected function connect() {
        try {
            $dsn = 'sqlite:' . $this->dbName;
            $pdo = new PDO($dsn);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            error_log("Database connection error: " . $e->getMessage());
            throw new Exception("Database connection error: " . $e->getMessage());
        }
    }
}