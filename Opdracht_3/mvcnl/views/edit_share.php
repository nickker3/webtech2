<?php
// views/edit_share.php


if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php?page=login");
    exit;
}

$shareId = isset($_GET['id']) ? (int)$_GET['id'] : null;
$editShareController = new EditShareController(new ShareModel());
$share = $editShareController->getShare($shareId);

// Controleer of de share bestaat en de gebruiker de eigenaar is
if (!$share || $share['user_id'] != $_SESSION['user_id']) {
    echo "U heeft geen toestemming om deze share te bewerken.";
    exit;
}

// Verwerk de update bij een POST-verzoek
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $link = $_POST['link'];

    if ($editShareController->updateShare($shareId, $title, $body, $link)) {
        header("Location: ../index.php?page=home");
        exit;
    } else {
        $error = "Er is een fout opgetreden bij het bijwerken van de share.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Share Bewerken</title>
</head>
<body>
<h2>Share Bewerken</h2>

<?php if (isset($error)): ?>
    <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form action="../index.php?page=dit_share.php?id=<?php echo $shareId; ?>" method="POST">
    <label>Titel: <input type="text" name="title" value="<?php echo htmlspecialchars($share['title']); ?>" required></label><br>
    <label>Inhoud: <textarea name="body" required><?php echo htmlspecialchars($share['body']); ?></textarea></label><br>
    <label>Link: <input type="url" name="link" value="<?php echo htmlspecialchars($share['link']); ?>"></label><br>
    <button type="submit">Share Bijwerken</button>
</form>
</body>
</html>
