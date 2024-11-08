<?php
// process_add_share.php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php?page=login");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $link = $_POST['link'];
    $userId = $_SESSION['user_id'];

    $addShareController = new AddShareController(new ShareModel());

    try {
        $addShareController->addShare($title, $body, $link, $userId);
        echo "Share succesvol toegevoegd! <a href='../index.php?page=home'>Bekijk alle shares</a>";
    } catch (Exception $e) {
        echo "Fout bij het toevoegen van de share: " . $e->getMessage();
        echo "<br><a href='../index.php?page=addShare'>Probeer opnieuw</a>";
    }
}
