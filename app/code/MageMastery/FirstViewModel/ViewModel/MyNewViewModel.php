<?php

namespace MageMastery\FirstViewModel\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use MageMastery\FirstViewModel\Model\User;
use MageMastery\FirstViewModel\Model\UserFactory;

class MyNewViewModel implements ArgumentInterface
{
    private UserFactory $userFactory;
    /** @var User $user */
    private User $user;

    public function __construct(UserFactory $userFactory)
    {
        $this->userFactory = $userFactory;
        $this->user = $this->userFactory->create();
    }

    public function getTitle()
    {
        return 'Viewmodel works!';
    }

    public function getUserName()
    {
        return $this->user->getData('firstName');
    }
}
