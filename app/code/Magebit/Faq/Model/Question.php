<?php

declare(strict_types=1);

namespace Magebit\Faq\Model;

use Magebit\Faq\Model\ResourceModel\Question as QuestionResourceModel;

class Question extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(QuestionResourceModel::class);
    }
}
