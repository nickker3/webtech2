<?php
  class UsersView extends Users {
    public function showUser($naam) {
      $results = $this->getUser($naam);
      echo "Naam: " . $results[0]['users_voor'] . " " . $results[0]['users_achter'] . "<br>";
      echo "Geboortedatum: " . $results[0]['users_gebdat'];
    }
  }
