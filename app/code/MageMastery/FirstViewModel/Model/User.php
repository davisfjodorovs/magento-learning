<?php

declare(strict_types=1);

namespace MageMastery\FirstViewModel\Model;

use Magento\Framework\Model\AbstractModel;
use MageMastery\FirstViewModel\Model\ResourceModel\User as UserResouceModel;

class User extends AbstractModel
{
    private String $firstName;

    protected function _construct(): Void
    {
        $this->_init(UserResouceModel::class);
    }
}
