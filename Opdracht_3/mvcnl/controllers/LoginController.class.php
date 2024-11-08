<?php
// controllers/LoginController.class.php

class LoginController {
    private $userModel;

    public function __construct($userModel) {
        $this->userModel = $userModel;
    }

    public function login($username, $password) {
        $user = $this->userModel->getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            return true;
        } else {
            throw new Exception("Onjuiste gebruikersnaam of wachtwoord.");
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
    }
}
