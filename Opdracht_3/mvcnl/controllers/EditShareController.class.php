<?php
// controllers/EditShareController.class.php

class EditShareController {
    private ShareModel $shareModel;

    public function __construct(ShareModel $shareModel) {
        $this->shareModel = $shareModel;
    }

    public function getShare(int $shareId) {
        return $this->shareModel->getShareById($shareId);
    }

    public function updateShare(int $shareId, string $title, string $body, ?string $link): bool {
        return $this->shareModel->updateShare($shareId, $title, $body, $link);
    }
}
