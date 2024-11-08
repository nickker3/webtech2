<?php
// views/register.php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userModel = new UserModel();

    try {
        $userModel->register($username, $email, $password);
        echo "Registratie succesvol! <a href='login.php'>Inloggen</a>";
    } catch (Exception $e) {
        echo "Fout bij registratie: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Registreren</title>
</head>
<body>
<h2>Registreren</h2>
<form action="../index.php?page=register" method="POST">
    <label>Gebruikersnaam: <input type="text" name="username" required></label><br>
    <label>E-mail: <input type="email" name="email" required></label><br>
    <label>Wachtwoord: <input type="password" name="password" required></label><br>
    <button type="submit">Registreren</button>
</form>
</body>
</html>
