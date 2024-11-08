<?php
// views/add_share.php



// Controleer of de gebruiker is ingelogd
if (!isLoggedIn()) {
    header("Location: ../index.php?page=login");
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Nieuwe Share Toevoegen</title>
</head>
<body>
<h2>Nieuwe Share Toevoegen</h2>
<form action="../process_add_share.php" method="POST">
    <label>Titel: <input type="text" name="title" required></label><br>
    <label>Inhoud: <textarea name="body" required></textarea></label><br>
    <label>Link: <input type="url" name="link"></label><br>
    <button type="submit">Share Toevoegen</button>
</form>
</body>
</html>
