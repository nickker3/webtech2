<?php
// index.php

// Start de sessie
session_start();

// Voeg de autoload en helpers toe, alleen hier in de centrale router
require_once 'includes/class-autoload.inc.php';
require_once 'includes/helpers.php';

// Bepaal de pagina op basis van de URL-parameter 'page'
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shareboard</title>
</head>
<body>

<!-- Navigatiebalk -->
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

<!-- Inhoud van de pagina -->
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
        // Vernietig de sessie en log de gebruiker uit
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
