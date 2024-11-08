<?php

// controllers/DeleteShareController.class.php

class DeleteShareController
{
    private ShareModel $shareModel;

    public function __construct(ShareModel $shareModel)
    {
        $this->shareModel = $shareModel;
    }

    public function deleteShare(int $shareId): bool
    {
        return $this->shareModel->deleteShareById($shareId);
    }
}
