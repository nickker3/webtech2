<?php
// views/login.php



// Verwerk het formulier bij een POST-verzoek
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Gebruik de LoginController voor de loginlogica
    $loginController = new LoginController(new UserModel());

    if ($loginController->login($username, $password)) {
        // Bij succesvolle login omleiden naar homepagina
        header("Location: ../index.php?page=home");
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
    <title>Inloggen</title>
</head>
<body>
<h2>Inloggen</h2>

<?php if (isset($error)): ?>
    <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form action="../index.php?page=login" method="POST">
    <label>Gebruikersnaam: <input type="text" name="username" required></label><br>
    <label>Wachtwoord: <input type="password" name="password" required></label><br>
    <button type="submit">Inloggen</button>
</form>

<p>Nog geen account? <a href="index.php?page=register">Registreer hier</a></p>
</body>
</html>
