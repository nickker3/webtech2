<?php
// classes/UserModel.class.php

class UserModel extends dbh {
    // Controleer of de gebruikersnaam al bestaat
    public function isUsernameTaken($username) {
        $sql = "SELECT COUNT(*) FROM users WHERE username = :username";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetchColumn() > 0; // Return true als gebruikersnaam bestaat
    }

    // Controleer of het e-mailadres al bestaat
    public function isEmailTaken($email) {
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0; // Return true als e-mail bestaat
    }

    // Voeg hier ook andere methodes toe, zoals createUser, indien nog niet gedaan
    public function createUser($username, $email, $password) {
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
    }
}
