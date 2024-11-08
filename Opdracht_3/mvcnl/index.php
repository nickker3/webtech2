<?php
// index.php

session_start();

require_once __DIR__ . '/includes/class-autoload.inc.php';
require_once __DIR__ . '/includes/helpers.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Verwerking voor deleteShare actie
if ($action === 'deleteShare' && isset($_GET['id']) && isLoggedIn()) {
    $shareId = (int)$_GET['id'];
    $deleteShareController = new DeleteShareController(new ShareModel());

    if ($deleteShareController->deleteShare($shareId)) {
        header("Location: index.php?page=home&message=deleted");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Er is een fout opgetreden bij het verwijderen van de share.</div>";
    }
}

// Verwerking voor editShare actie
if ($action === 'editShare' && isset($_GET['id']) && isLoggedIn()) {
    require 'views/edit_share.php';
    exit;
}

// Verwerking voor registratie
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

// Verwerking voor login
if ($page === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $loginController = new LoginController(new UserModel());

    if ($loginController->login($username, $password)) {
        header("Location: index.php?page=home");
        exit;
    } else {
        $error = "Ongeldige gebruikersnaam of wachtwoord.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shareboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navigatiebalk -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php?page=home">Shareboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <?php if (isLoggedIn()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=addShare">Nieuwe Share</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=logout">Uitloggen</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=register">Registreren</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=login">Inloggen</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <?php
    // Weergeven van pagina-inhoud op basis van de opgegeven pagina
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
                echo "<div class='alert alert-warning'>U moet ingelogd zijn om een share toe te voegen.</div>";
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
</div>

<!-- Bootstrap en jQuery JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
