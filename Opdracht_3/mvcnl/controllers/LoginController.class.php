<?php
// controllers/LoginController.class.php

class LoginController {
    private UserModel $userModel;

    public function __construct(UserModel $userModel) {
        $this->userModel = $userModel;
    }

    public function login(string $username, string $password): bool {
        $user = $this->userModel->login($username, $password);

        if ($user) {
            // Sla de user_id op in de sessie
            $_SESSION['user_id'] = $user['id'];
            return true;
        }

        // Login mislukt
        return false;
    }
}
