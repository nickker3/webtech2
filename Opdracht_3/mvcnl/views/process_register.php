<?php
// process_register.php
session_start();
require_once '../includes/class-autoload.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $registerController = new RegisterController(new UserModel());

    try {
        $registerController->register($username, $email, $password);
        echo "Registratie succesvol! U kunt nu <a href='../index.php?page=login'>inloggen</a>.";
    } catch (Exception $e) {
        error_log("Registration error: " . $e->getMessage());
        echo "Registratie mislukt: " . $e->getMessage();
        echo "<br><a href='index.php?page=register'>Probeer opnieuw</a>";
    }
}