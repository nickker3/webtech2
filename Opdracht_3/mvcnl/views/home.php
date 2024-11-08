<?php
// views/home.php



$shareModel = new ShareModel();
$shares = $shareModel->getAllShares();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
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

            <?php if (isLoggedIn() && $_SESSION['user_id'] == $share['user_id']): ?>
                <p>
                    <a href="index.php?action=editShare&id=<?php echo $share['id']; ?>">Bewerken</a> |
                    <a href="index.php?action=deleteShare&id=<?php echo $share['id']; ?>" onclick="return confirm('Weet u zeker dat u deze share wilt verwijderen?');">Verwijderen</a>
                </p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
</body>
</html>
