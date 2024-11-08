<?php
// controllers/EditShareController.class.php

class EditShareController {
    private $shareModel;

    public function __construct($shareModel) {
        $this->shareModel = $shareModel;
    }

    public function editShare($shareId, $title, $body, $link) {
        if (!isset($_SESSION['user_id'])) {
            throw new Exception("U moet ingelogd zijn om een share te bewerken.");
        }

        $userId = $_SESSION['user_id'];
        $share = $this->shareModel->getShareById($shareId);

        if ($share['user_id'] !== $userId) {
            throw new Exception("U mag alleen uw eigen shares bewerken.");
        }

        return $this->shareModel->updateShare($shareId, $title, $body, $link);
    }
}
