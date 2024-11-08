<?php
// index.php

// Start een sessie
session_start();

// Voeg de autoloader toe
require_once 'includes/class-autoload.inc.php';

// Controleer of de gebruiker is ingelogd
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Routering op basis van URL-parameters
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Header (HTML)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shareboard</title>
</head>
<body>

<?php
// Navigatiebalk
echo '<nav>';
if (isLoggedIn()) {
    echo '<a href="index.php?page=home">Home</a> | ';
    echo '<a href="index.php?page=addShare">Add Share</a> | ';
    echo '<a href="index.php?page=logout">Logout</a>';
} else {
    echo '<a href="index.php?page=home">Home</a> | ';
    echo '<a href="index.php?page=register">Register</a> | ';
    echo '<a href="index.php?page=login">Login</a>';
}
echo '</nav><hr>';

// Routering op basis van de $page-waarde
switch ($page) {
    case 'register':
        require 'views/register.php';
        break;
    case 'login':
        require 'views/login.php';
        break;
    case 'addShare':
        if (isLoggedIn()) {
            require 'add_share.php';
        } else {
            echo "<p>Please log in to add a share.</p>";
        }
        break;
    case 'logout':
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
