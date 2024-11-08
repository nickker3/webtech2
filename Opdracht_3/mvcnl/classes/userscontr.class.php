<?php
  class UsersContr extends Users {
    public function createUser($voornaam, $achternaam, $gebdat) {
      $this->setUser($voornaam, $achternaam, $gebdat);
    }
  }
