<?php
// index.php

session_start();

require_once __DIR__ . '/includes/class-autoload.inc.php';
require_once __DIR__ . '/includes/helpers.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Verwerk registratie bij een POST-verzoek aan index.php?page=register
if ($page === 'register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userModel = new UserModel();

    try {
        $userModel->register($username, $email, $password);
        header("Location: index.php?page=login");
        exit;
    } catch (Exception $e) {
        $error = "Fout bij registratie: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shareboard</title>
</head>
<body>

<nav>
    <a href="index.php?page=home">Home</a> |
    <?php if (isLoggedIn()): ?>
        <a href="index.php?page=addShare">Voeg een nieuwe share toe</a> |
        <a href="index.php?page=logout">Uitloggen</a>
    <?php else: ?>
        <a href="index.php?page=register">Registreren</a> |
        <a href="index.php?page=login">Inloggen</a>
    <?php endif; ?>
</nav>
<hr>

<?php
switch ($page) {
    case 'register':
        require 'views/register.php';
        break;
    case 'login':
        require 'views/login.php';
        break;
    case 'addShare':
        if (isLoggedIn()) {
            require 'views/add_share.php';
        } else {
            echo "<p>U moet ingelogd zijn om een share toe te voegen.</p>";
        }
        break;
    case 'logout':
        session_unset();
        session_destroy();
        header("Location: index.php?page=home");
        exit;
    default:
        require 'views/home.php';
        break;
}
?>
</body>
</html>
