<?php

declare(strict_types=1);

namespace MageMastery\FirstViewModel\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class User extends AbstractDb
{
    protected function _construct(): Void
    {
        $this->_init('users', 'user_id');
    }
}
