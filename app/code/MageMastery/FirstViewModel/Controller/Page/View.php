<?php

declare(strict_types=1);

namespace MageMastery\FirstViewModel\Controller\Page;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;
use MageMastery\FirstViewModel\Model\User;
use MageMastery\FirstViewModel\Model\UserFactory;

class View implements ActionInterface
{
    /** @var PageFactory $resultFactory */
    private PageFactory $resultFactory;
    private UserFactory $userFactory;

    public function __construct(PageFactory $resultFactory, UserFactory $userFactory)
    {
        $this->resultFactory = $resultFactory;
        $this->userFactory = $userFactory;
    }

    public function execute(): Page
    {
        /** @var Page $page */
        $page = $this->resultFactory->create();

        /** @var User $user */
        $user = $this->userFactory->create();
        $user->setData('firstName', 'Bob');

        return $page;
    }
}
