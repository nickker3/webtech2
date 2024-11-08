<?php
// controllers/AddShareController.class.php

class AddShareController {
    private $shareModel;

    public function __construct($shareModel) {
        $this->shareModel = $shareModel;
    }

    public function addShare($title, $body, $link) {
        if (!isset($_SESSION['user_id'])) {
            throw new Exception("U moet ingelogd zijn om een share toe te voegen.");
        }

        $userId = $_SESSION['user_id'];
        return $this->shareModel->createShare($title, $body, $link, $userId);
    }
}
