<?php
// classes/UserController.class.php

class UserController {
    private $userModel;

    public function __construct($userModel) {
        $this->userModel = $userModel;
    }

    // Verwerkt de inlogpoging van een gebruiker
    public function login($username, $password) {
        $user = $this->userModel->getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            return true;
        } else {
            throw new Exception("Onjuiste gebruikersnaam of wachtwoord.");
        }
    }

    // Verwerkt het uitloggen van de gebruiker
    public function logout() {
        session_unset();
        session_destroy();
    }

    // Controleer of de gebruiker is ingelogd
    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    // Haalt de huidige gebruiker op uit de sessie (indien ingelogd)
    public function getCurrentUser() {
        if ($this->isLoggedIn()) {
            return $this->userModel->getUserById($_SESSION['user_id']);
        }
        return null;
    }
}
