<?php
// process_login.php
//session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $loginController = new LoginController(new UserModel());

    try {
        $loginController->login($username, $password);
        header("Location: ../index.php?page=home");
    } catch (Exception $e) {
        echo "Inloggen mislukt: " . $e->getMessage();
        echo "<br><a href='../index.php?page=login'>Probeer opnieuw</a>";
    }
}
