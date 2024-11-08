<!-- home.php -->
<h2>Alle Shares</h2>
<?php
$shareModel = new ShareModel();
$shares = $shareModel->getAllShares();

if (empty($shares)) {
    echo "<p>Er zijn nog geen shares.</p>";
} else {
    foreach ($shares as $share) {
        echo "<h3>{$share['title']}</h3>";
        echo "<p>{$share['body']}</p>";
        echo "<p><a href='{$share['link']}' target='_blank'>Lees meer</a></p>";
        echo "<hr>";
    }
}
?>
