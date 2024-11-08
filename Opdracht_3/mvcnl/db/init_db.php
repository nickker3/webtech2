<?php

try {
    // Connect to the SQLite database
    $pdo = new PDO('sqlite:../db/database.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Read the SQL file from the 'db' directory
    $sql = file_get_contents('../db/create_sqlite_tables.sql');

    // Execute the SQL queries to create the tables
    $pdo->exec($sql);

    echo "Tables created successfully!";
} catch (PDOException $e) {
    echo "Error creating tables: " . $e->getMessage();
}
?>