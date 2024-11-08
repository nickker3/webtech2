<?php
// controllers/AddShareController.class.php

class AddShareController {
    private ShareModel $shareModel; // Type-aanduiding toegevoegd

    public function __construct(ShareModel $shareModel) {
        $this->shareModel = $shareModel;
    }

    public function addShare($title, $body, $link, $userId) {
        if (empty($title) || empty($body)) {
            throw new Exception("Titel en inhoud mogen niet leeg zijn.");
        }
        $this->shareModel->createShare($title, $body, $link, $userId);
    }
}
