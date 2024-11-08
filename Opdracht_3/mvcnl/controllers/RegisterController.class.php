<?php
// controllers/RegisterController.class.php

class RegisterController {
    private $userModel;

    public function __construct($userModel) {
        $this->userModel = $userModel;
    }

    public function register($username, $email, $password) {
        if ($this->userModel->isUsernameTaken($username)) {
            throw new Exception("De gebruikersnaam is al in gebruik.");
        }

        if ($this->userModel->isEmailTaken($email)) {
            throw new Exception("Het e-mailadres is al in gebruik.");
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        return $this->userModel->createUser($username, $email, $hashedPassword);
    }
}
