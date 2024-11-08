<?php
// classes/ShareModel.class.php

class ShareModel extends Dbh
{
    // Bestaat al: Methode om alle shares op te halen
    public function getAllShares(): array
    {
        $sql = "SELECT * FROM shares ORDER BY created_at DESC";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Bestaat al: Methode om een nieuwe share toe te voegen
    public function createShare($title, $body, $link, $userId): void
    {
        $sql = "INSERT INTO shares (title, body, link, user_id, created_at) VALUES (:title, :body, :link, :user_id, CURRENT_TIMESTAMP)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':body', $body);
        $stmt->bindParam(':link', $link);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
    }

    // Nieuwe methode om een share te verwijderen op basis van het ID
    public function deleteShareById(int $shareId): bool
    {
        $sql = "DELETE FROM shares WHERE id = :shareId";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':shareId', $shareId, PDO::PARAM_INT);
        return $stmt->execute();


    }
    public function getShareById(int $shareId) {
        $sql = "SELECT * FROM shares WHERE id = :shareId";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':shareId', $shareId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updateShare(int $shareId, string $title, string $body, ?string $link): bool {
        $sql = "UPDATE shares SET title = :title, body = :body, link = :link WHERE id = :shareId";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':body', $body);
        $stmt->bindParam(':link', $link);
        $stmt->bindParam(':shareId', $shareId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
