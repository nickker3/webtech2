<!-- add_share.php -->
<?php
session_start();


// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    echo "U moet ingelogd zijn om een share toe te voegen.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share Toevoegen</title>
</head>
<body>

<h2>Nieuwe Share Toevoegen</h2>
<form action="../views/process_add_share.php" method="POST">
    <label>Titel: <input type="text" name="title" required></label><br>
    <label>Inhoud: <textarea name="body" required></textarea></label><br>
    <label>Link: <input type="url" name="link"></label><br>
    <button type="submit">Share Toevoegen</button>
</form>

</body>
</html>
