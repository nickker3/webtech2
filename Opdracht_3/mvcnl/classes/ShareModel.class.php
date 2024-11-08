<?php
// classes/ShareModel.class.php

class ShareModel extends dbh {

    // Methode om alle shares op te halen
    public function getAllShares(): array {
        $sql = "SELECT * FROM shares ORDER BY created_at DESC";
        $stmt = $this->connect()->query($sql); // Veronderstelt dat dbh een connectie biedt
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourneert een array
    }

    // Methode om een nieuwe share toe te voegen
    public function createShare($title, $body, $link, $userId): void {
        $sql = "INSERT INTO shares (title, body, link, user_id, created_at) VALUES (:title, :body, :link, :user_id, CURRENT_TIMESTAMP)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':body', $body);
        $stmt->bindParam(':link', $link);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
    }
}
