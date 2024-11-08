<?php
// controllers/DeleteShareController.class.php

class DeleteShareController {
    private $shareModel;

    public function __construct($shareModel) {
        $this->shareModel = $shareModel;
    }

    public function deleteShare($shareId) {
        if (!isset($_SESSION['user_id'])) {
            throw new Exception("U moet ingelogd zijn om een share te verwijderen.");
        }

        $userId = $_SESSION['user_id'];
        $share = $this->shareModel->getShareById($shareId);

        if ($share['user_id'] !== $userId) {
            throw new Exception("U mag alleen uw eigen shares verwijderen.");
        }

        return $this->shareModel->deleteShare($shareId);
    }
}
