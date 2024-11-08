<?php
  class Users extends Dbh {
    protected function getUser($naam) {
      $sql = "SELECT * FROM users WHERE users_voor = ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$naam]);
      // Use fetch() for 1 row, and fetchAll() for all rows
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $results;
    }

    protected function setUser($voornaam, $achternaam, $gebdat) {
      $sql = "INSERT INTO users(users_voor, users_achter, users_gebdat) VALUES (?, ?, ?)";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$voornaam, $achternaam, $gebdat]);
    }
  }
