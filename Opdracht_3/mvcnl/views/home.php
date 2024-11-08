<?php
session_start();


// Maak een nieuw ShareModel-object aan om shares op te halen

$shareModel = new ShareModel();
$shares = $shareModel->getAllShares(); // Haal alle shares op
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shareboard - Home</title>
</head>
<body>

<h1>Welkom bij Shareboard</h1>

<?php if (isLoggedIn()): ?>
    <p><a href="index.php?page=addShare">Voeg een nieuwe share toe</a></p>
<?php else: ?>
    <p><a href="index.php?page=login">Log in</a> of <a href="index.php?page=register">Registreer</a> om een share toe te voegen.</p>
<?php endif; ?>

<h2>Gedeelde Items</h2>

<?php if (empty($shares)): ?>
    <p>Er zijn nog geen shares toegevoegd.</p>
<?php else: ?>
    <?php foreach ($shares as $share): ?>
        <div style="border: 1px solid #ddd; padding: 10px; margin: 10px 0;">
            <h3><?php echo htmlspecialchars($share['title']); ?></h3>
            <p><?php echo nl2br(htmlspecialchars($share['body'])); ?></p>
            <?php if (!empty($share['link'])): ?>
                <p><a href="<?php echo htmlspecialchars($share['link']); ?>" target="_blank">Lees meer</a></p>
            <?php endif; ?>
            <p><small>Gepubliceerd op: <?php echo htmlspecialchars($share['created_at']); ?></small></p>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

</body>
</html>
