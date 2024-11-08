<?php
// classes/ShareModel.class.php

class ShareModel extends Dbh {
    public function getAllShares(): array {
        $sql = "SELECT * FROM shares ORDER BY created_at DESC";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

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
